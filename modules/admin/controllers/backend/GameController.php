<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 27.03.2017
 * Time: 14:34
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\query\GameQuery;
use app\modules\admin\services\GamesEditService;
use app\traits\ContainerAwareTrait;
use app\modules\admin\models\Game;
use yii\web\Controller;
use Yii;
use yii\filters\VerbFilter;
use app\modules\admin\Module;
use yii\web\NotFoundHttpException;
use app\modules\admin\events\ItemEvent;
use yii\db\ActiveRecord;
use app\modules\admin\services\ItemCreateService;

class GameController extends Controller
{
    /** @var  $gameQuery GameQuery */
    protected $gameQuery;

    use ContainerAwareTrait;

    public function __construct($id, Module $module, GameQuery $gameQuery, array $config = [])
    {
        $this->gameQuery = $gameQuery;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionSetScore()
    {
        $post = Yii::$app->request->post();
        $tour = $post['tour'];
        $tournament = $post['tournament_id'];

        /** @var Game[] $games */
        $games = $this->gameQuery->whereTourInTournament($tournament, $tour)->indexBy('id')->all();

        if (Game::loadMultiple($games, $post) && Game::validateMultiple($games)) {
            if ($this->make(GamesEditService::class, [$games, $tournament, $tour])->run()) {
                Yii::$app->session->setFlash('success', 'Данные успешно сохранены');
            } else {
                Yii::$app->session->setFlash('error', 'Что-то полшо не так см логи');
            }
        }

        $this->redirect(['tournament/schedule', 'id' => $tournament]);
    }

    public function actionDelete($id)
    {
        try {
            /** @var Game $game */
            $game = $this->findModel($id);

            $tournament_id = $game->tournament_id;
            /** @var ItemEvent $event */
            $event = $this->make(ItemEvent::class, [$game]);
            $game->delete();
            Yii::$app->session->setFlash('success', "Игра $game->id успешно удалена");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/schedule', 'id' => $tournament_id]);
    }

    public function actionCreate()
    {
        /** @var Game $model*/
        $model = $this->make(Game::class);

        if($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($this->make(ItemCreateService::class, [$model])->run()) {
                Yii::$app->session->setFlash('success', "Игра успешно добавлена");
            } else {
                Yii::$app->session->setFlash('error', 'Невозможно создать игру. См лог файл для деталей');
            }
            return $this->redirect(['tournament/schedule', 'id' => $model->tournament_id]);
        }
    }

    protected function findModel($id)
    {
        if ($model = $this->gameQuery->where(['id' => $id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('Нельзя удалить несуществующую игру');
        }
    }
}
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

}
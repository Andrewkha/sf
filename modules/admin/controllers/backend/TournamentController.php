<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\models\TeamTournament;
use app\modules\admin\models\Team;
use app\modules\admin\services\AddParticipantService;
use app\modules\admin\services\ForecastReminderService;
use app\modules\admin\services\TournamentEditService;
use app\modules\admin\validator\AjaxRequestModelValidator;
use app\modules\admin\services\ItemCreateService;
use Yii;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\search\TournamentSearch;
use yii\base\Exception;
use yii\web\Controller;
use app\traits\ContainerAwareTrait;
use yii\base\Module;
use app\modules\admin\models\query\TournamentQuery;
use yii\filters\VerbFilter;
use app\modules\admin\events\ItemEvent;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;


/**
 * TournamentController implements the CRUD actions for Tournament model.
 */
class TournamentController extends Controller
{

    use ContainerAwareTrait;

    /**
     * @var TournamentQuery
     */
    protected $tournamentQuery;

    public function __construct($id, Module $module, TournamentQuery $tournamentQuery, array $config = [])
    {
        $this->tournamentQuery = $tournamentQuery;
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
                    'remove-participant' => ['POST'],
                    'remind' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tournament models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TournamentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        /**
         * @var $editModel TournamentCreateEditForm
         * Used for editing the selected model
         */
        $editModel = $this->make(TournamentCreateEditForm::class);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'editModel' => $editModel,
        ]);
    }

    /**
     * Edit the tournament details
     * @return mixed
     */

    public function actionEdit()
    {
        /** @var TournamentCreateEditForm $formData */
        $formData = $this->make(TournamentCreateEditForm::class);

        $this->make(AjaxRequestModelValidator::class, [$formData])->validate();

        if($formData->load(Yii::$app->request->post()) && $formData->validate()) {

            try {
                $tournament = $this->findModel($formData->id);
            } catch (Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->redirect(['tournament/']);
            }
            if ($this->make(TournamentEditService::class,[$formData, $tournament])->run()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка изменения');
            }
            return $this->redirect(['tournament/']);
        }
    }

    /**
     * Creates a new Tournament model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        /** @var TournamentCreateEditForm $form*/
        $form = $this->make(TournamentCreateEditForm::class);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $tournament = $this->make(Tournament::class, [], $form->attributes);

            if ($this->make(ItemCreateService::class, [$tournament])->run()) {
                Yii::$app->session->setFlash('success', "Турнир успешно добавлен");
            } else {
                Yii::$app->session->setFlash('error', 'Невозможно создать турнир. См лог файл для деталей');
            }
            return $this->redirect(['tournament/']);
        }
    }

    /**
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            /** @var Tournament $tournament */
            $tournament = $this->findModel($id);

            /** @var ItemEvent $event */
            $event = $this->make(ItemEvent::class, [$tournament]);
            $tournament->delete();
            Yii::$app->session->setFlash('success', "Турнир $tournament->tournament успешно удален");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/']);

    }


    public function actionDetails($id)
    {
        try {
            $tournament = $this->findModel($id);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['tournament/']);
        }
        return $this->render('details', ['tournament' => $tournament]);
    }


    public function actionAddParticipants($id)
    {
        $post = Yii::$app->request->post();

        try {
            $tournament = $this->findModel($id);
            if ($this->make(AddParticipantService::class, [$tournament, $post['candidates']])->run())
                Yii::$app->session->setFlash('success', 'Участники успешно добавлены');
            else
                Yii::$app->session->setFlash('error', 'Что-то пошло не так');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/details', 'id' => $id]);
    }

    public function actionRemoveParticipant($id, $tournament)
    {
        try {
            /** @var Tournament $tournament */
            $tournament = $this->findModel($tournament);
            /** @var Team $team */
            $team = $tournament->getTeams()->andWhere(['id' => $id])->one();
            $tournament->unlink('teams', $team, true);
            Yii::$app->session->setFlash('success', "Команда $team->team удалена из турнира $tournament->tournament");

        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/details', 'id' => $tournament->id]);
    }

    /**
     * Assigns the autoprocess aliases to the teams for the tournament
     * @param $id integer is a Tournament id
     * @return mixed
    */

    public function actionAlias($id)
    {
        try {
            /** @var Tournament $tournament */
            $tournament = $this->findModel($id);
            $models = $tournament->getTeamTournaments()->with('team')->indexBy('id')->all();

            if (!empty($models))
            /** @var TeamTournament $item */
                foreach ($models as &$item)
                    $item->setScenario(TeamTournament::SCENARIO_ALIAS_ASSIGN);
            else
                throw new Exception('Сначала добавьте участников');

            if (TeamTournament::loadMultiple($models, Yii::$app->request->post())) {
                foreach ($models as $model) {
                    $model->save(false);
                }
                Yii::$app->session->setFlash('success','Псевдонимы успешно добавлены');
                return $this->redirect(['tournament/details', 'id' => $tournament->id]);
            }

        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['tournament/details', 'id' => $id]);
        }
        return $this->render('alias', ['tournament' => $tournament, 'models' => $models]);
    }

    public function actionRemind($id, $tour)
    {
        try {
            /** @var Tournament $tournament */
            $tournament = $this->findModel($id);
            if ($this->make(ForecastReminderService::class, [$tournament, $tour])->run())
                Yii::$app->session->setFlash('success', 'Напоминания успешно отправлены');
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/details', 'id' => $id]);
    }

    protected function findModel($id)
    {
        if ($model = $this->tournamentQuery->where(['id' => $id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такого турнира нет');
        }
    }
}

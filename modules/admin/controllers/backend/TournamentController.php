<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\forms\TournamentCreateEditForm;
use app\modules\admin\services\TournamentEditService;
use app\modules\admin\validator\AjaxRequestModelValidator;
use Yii;
use app\modules\admin\models\Tournament;
use app\modules\admin\models\search\TournamentSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\modules\admin\traits\ContainerAwareTrait;
use yii\base\Module;
use app\modules\admin\models\query\TournamentQuery;
use yii\filters\VerbFilter;
use app\modules\admin\events\ItemEvent;
use yii\db\ActiveRecord;
use app\modules\admin\events\TournamentEvent;

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
        /** @var Tournament $tournament*/
        $this->make(AjaxRequestModelValidator::class, [$formData])->validate();

        if($formData->load(Yii::$app->request->post()) && $formData->validate()) {

            if ($this->make(TournamentEditService::class,[$formData])->run()) {
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
        $model = new Tournament();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
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
        /** @var Tournament $tournament */
        $tournament = $this->tournamentQuery->where(['id' => $id])->one();

        /** @var ItemEvent $event */
        $event = $this->make(ItemEvent::class, [$tournament]);

        try {
            $tournament->delete();
            Yii::$app->session->setFlash('success', "Турнир $tournament->tournament успешно удален");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['tournament/']);
    }

}

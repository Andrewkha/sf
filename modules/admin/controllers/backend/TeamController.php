<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\query\TeamQuery;
use Yii;
use yii\helpers\ArrayHelper;
use kartik\grid\EditableColumnAction;
use app\modules\admin\models\Team;
use app\modules\admin\models\search\TeamSearch;
use app\modules\admin\services\ItemCreateService;
use yii\web\Controller;
use app\modules\admin\events\ItemEvent;
use yii\db\ActiveRecord;
use yii\filters\VerbFilter;
use yii\base\Module;
use app\modules\admin\traits\ContainerAwareTrait;
use app\modules\admin\forms\TeamCreateEditForm;
use app\modules\admin\validator\AjaxRequestModelValidator;

/**
 * TeamController implements the CRUD actions for Team model.
 */
class TeamController extends Controller
{
    use ContainerAwareTrait;

    /**
     * @var TeamQuery
     */
    protected $teamQuery;

    public function __construct($id, Module $module, TeamQuery $teamQuery, array $config = [])
    {
        $this->teamQuery = $teamQuery;
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

    public function actions()
    {
        return ArrayHelper::merge(parent::actions(), [
            'update' => [                                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),                   // action class name
                'modelClass' => Team::class,       // the update model class
            ]
        ]);
    }

    /**
     * Lists all Team models.
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var TeamCreateEditForm $form*/
        $form = $this->make(TeamCreateEditForm::class);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $country = $this->make(Team::class, [], $form->attributes);

            if ($this->make(ItemCreateService::class, [$country])->run()) {
                Yii::$app->session->setFlash('success', "Страна успешно создана");

                return $this->redirect(['team/']);
            } else {
                Yii::$app->session->setFlash('error', 'Невозможно создать команду. См лог файл для деталей');
            }
        }

        $searchModel = $this->make(TeamSearch::class);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing Team model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /** @var Team $team */
        $team = $this->teamQuery->where(['id' => $id])->one();

        /** @var ItemEvent $event */
        $event = $this->make(ItemEvent::class, [$team]);

        try {
            $team->delete();
            Yii::$app->session->setFlash('success', "Команда $team->team успешно удалена");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['team/']);
    }
}
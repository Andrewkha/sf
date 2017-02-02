<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\services\AdminCRUDService;
use kartik\grid\EditableColumnAction;
use Yii;
use app\modules\admin\models\search\CountrySearch;
use app\modules\admin\forms\CountryCreateEditForm;
use app\modules\admin\models\Country;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    private $adminCRUDService;

    public function __construct($id, $module, AdminCRUDService $adminCRUDService, array $config = [])
    {
        $this->adminCRUDService = $adminCRUDService;
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
                'modelClass' => $this->adminCRUDService->getARClassCountry(),       // the update model class
            ]
        ]);
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new CountryCreateEditForm();
        $model->load(Yii::$app->request->post());
        $model->validate();
        print_r($model);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CountryCreateEditForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $country = $this->adminCRUDService->findCountry($id);

        try {
            $this->adminCRUDService->deleteCountry($id);
            Yii::$app->session->setFlash('success', "Страна $country->country успешно удалена");
;
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['country/']);
    }

}

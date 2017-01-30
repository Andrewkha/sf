<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\services\AdminService;
use kartik\grid\EditableColumnAction;
use Yii;
use app\modules\admin\models\search\CountrySearch;
use app\modules\admin\forms\CountryCreateEditForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    private $adminService;

    public function __construct($id, $module, AdminService $adminService, array $config = [])
    {
        $this->adminService = $adminService;
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
            'update' => [                                       // identifier for your editable action
                'class' => EditableColumnAction::className(),     // action class name
                'modelClass' => $this->adminService->getARClassCountry(),                // the update model class
            ]
        ]);
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        $form = new CountryCreateEditForm();
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $form,
        ]);
    }

    /**
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $form = new CountryCreateEditForm();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->adminService->addCountry($form->country);
                Yii::$app->session->setFlash('success', 'Запись успешно добавлена');
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->redirect(['country/']);
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $country = $this->adminService->findCountry($id);

        try {
            $this->adminService->deleteCountry($id);
            Yii::$app->session->setFlash('success', "Страна $country->country успешно удалена");
        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['country/']);
    }

}

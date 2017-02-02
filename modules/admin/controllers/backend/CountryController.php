<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\services\AdminCRUDService;
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
    private $adminCRUDService;

    public function __construct($id, $module, AdminCRUDService $adminCRUDCRUDService, array $config = [])
    {
        $this->adminCRUDService = $adminCRUDCRUDService;
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
        $form = new CountryCreateEditForm();
        $searchModel = new CountrySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $form = $this->save($form);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $form,
        ]);
    }

    /*
     * @param CountryCreateEditForm $form
     */

    private function save(CountryCreateEditForm $form)
    {
        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->adminCRUDService->addCountry($form->country);
                Yii::$app->session->setFlash('success', "Страна $form->country успешно добавлена");
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        } elseif($form->load(Yii::$app->request->post()) && !$form->validate()) {
            $form->setFormState(CountryCreateEditForm::FORM_STATE_OPEN);
        }

        return $form;
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

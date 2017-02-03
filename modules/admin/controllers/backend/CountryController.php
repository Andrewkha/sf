<?php

namespace app\modules\admin\controllers\backend;

use app\modules\admin\events\ItemEvent;
use app\modules\admin\models\Country;
use app\modules\admin\services\ItemCreateService;
use app\modules\admin\traits\ContainerAwareTrait;
use app\modules\admin\validator\AjaxRequestModelValidator;
use kartik\grid\EditableColumnAction;
use Yii;
use app\modules\admin\models\search\CountrySearch;
use app\modules\admin\forms\CountryCreateEditForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\base\Module;
use app\modules\admin\models\query\CountryQuery;
use yii\db\ActiveRecord;


/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
{
    use ContainerAwareTrait;

    /**
     * @var CountryQuery
     */
    protected $countryQuery;

    /**
     * CountryController constructor.
     *
     * @param string    $id
     * @param Module    $module
     * @param CountryQuery $countryQuery
     * @param array     $config
     */

    public function __construct($id, Module $module, CountryQuery $countryQuery, array $config = [])
    {
        $this->countryQuery = $countryQuery;
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
                'modelClass' => Country::class,       // the update model class
            ]
        ]);
    }

    /**
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {
        /** @var CountryCreateEditForm $form*/
        $form = $this->make(CountryCreateEditForm::class);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {
            $country = $this->make(Country::class, [], $form->attributes);

            if ($this->make(ItemCreateService::class, [$country])->run()) {
                Yii::$app->session->setFlash('success', "Страна успешно создана");

                return $this->redirect(['country/']);
            } else {
                Yii::$app->session->setFlash('error', 'Невозможно удалить страну. См лог файл для деталей');
            }
        }
        
        $searchModel = $this->make(CountrySearch::class);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $form,
        ]);
    }

    /**
     * Deletes an existing Country model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        /** @var Country $country */
        $country = $this->countryQuery->where(['id' => $id])->one();

        /** @var ItemEvent $event */
        $event = $this->make(ItemEvent::class, [$country]);

        try {
            $country->delete();
            Yii::$app->session->setFlash('success', "Страна $country->country успешно удалена");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['country/']);
    }

}

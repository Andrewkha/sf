<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 12:10 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\forms\NewzCreateEditForm;
use app\modules\admin\models\Newz;
use app\modules\admin\models\query\NewzQuery;
use app\modules\admin\models\search\NewzSearch;
use app\modules\admin\services\NewzEditService;
use app\traits\ContainerAwareTrait;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;
use app\modules\admin\Module;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use app\modules\admin\events\ItemEvent;
use yii\db\ActiveRecord;
use app\modules\admin\validator\AjaxRequestModelValidator;
use app\modules\admin\services\ItemCreateService;
use app\modules\user\models\User;

class NewsController extends Controller
{
    use ContainerAwareTrait;

    /** @var  NewzQuery */
    protected $newzQuery;

    public function __construct($id, Module $module, NewzQuery $newzQuery, array $config = [])
    {
        $this->newzQuery = $newzQuery;
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
                    'archive' => ['POST']
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new NewzSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {

        /** @var NewzCreateEditForm $form*/
        $form = $this->make(NewzCreateEditForm::class);

        $this->make(AjaxRequestModelValidator::class, [$form])->validate();

        if($form->load(Yii::$app->request->post()) && $form->validate()) {

            /** @var Newz $news */
            $news = $this->make(Newz::class, [], $form->attributes);
            //todo!!! replace with logged on person
            $news->user_id = User::ADMIN_ID;

            if ($this->make(ItemCreateService::class, [$news])->run()) {
                Yii::$app->session->setFlash('success', "Новость успешно добавлена");
            } else {
                Yii::$app->session->setFlash('error', 'Невозможно добавить новость. См лог файл для деталей');
            }
            return $this->redirect(['news/']);
        } else {
            return $this->render('create', ['form' => $form]);
        }
    }

    public function actionUpdate($id)
    {
        /** @var NewzCreateEditForm $formData */
        $formData = $this->make(NewzCreateEditForm::class);
        $this->make(AjaxRequestModelValidator::class, [$formData])->validate();

        try {
            $news = $this->findModel($id);

        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
            return $this->redirect(['news/']);
        }

        if ($formData->load(Yii::$app->request->post(), $news->formName()) && $formData->validate()) {
        //todo replace with logged on user
            $user_id = User::ADMIN_ID;

            if ($this->make(NewzEditService::class, [$formData, $news, $user_id])->run()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка изменения');
            }

            return $this->redirect(['news/']);
        }

        return $this->render('edit', ['form' => $news]);
    }

    public function actionArchive($id)
    {
        try {
            /** @var Newz $news */
            $news = $this->findModel($id);

            if ($news->isArchived() && $news->toActive()) {
                Yii::$app->session->setFlash('success', 'Новость активирована');
                return $this->redirect(['news/']);
            }

            if ($news->isActive() && $news->toArchive()) {
                Yii::$app->session->setFlash('success', 'Новость добавлена в архив');
                return $this->redirect(['news/']);
            }

        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['news/']);
    }

    public function actionDelete($id)
    {
        try {
            /** @var Newz $news */
            $news = $this->findModel($id);

            /** @var ItemEvent $event */
            $event = $this->make(ItemEvent::class, [$news]);
            $news->delete();
            Yii::$app->session->setFlash('success', "Новость успешно удалена");
            $this->trigger(ActiveRecord::EVENT_AFTER_DELETE, $event);

        } catch (\Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }

        return $this->redirect(['news/']);
    }

    protected function findModel($id)
    {
        if ($model = $this->newzQuery->where(['id' => $id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой новости нет');
        }
    }
}
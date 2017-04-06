<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 12:10 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\Newz;
use app\modules\admin\models\query\NewzQuery;
use app\modules\admin\models\search\NewzSearch;
use app\traits\ContainerAwareTrait;
use yii\web\Controller;
use yii\filters\VerbFilter;
use Yii;
use app\modules\admin\Module;
use yii\web\NotFoundHttpException;
use yii\base\Exception;

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

    protected function findModel($id)
    {
        if ($model = $this->newzQuery->where(['id' => $id])->one()) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой новости нет');
        }
    }
}
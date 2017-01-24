<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/24/2017
 * Time: 4:56 PM
 */
use kartik\alert\AlertBlock;
use app\modules\admin\resources\MenuItems;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

/** @var \yii\web\Controller $context */
$context = $this->context;

if (isset($this->params['breadcrumbs'])) {
    $panelBreadcrumbs = [['label' => 'Панель администратора', 'url' => ['/admin/default/index']]];
    $breadcrumbs = $this->params['breadcrumbs'];
} else {
    $panelBreadcrumbs = ['Панель администратора'];
    $breadcrumbs = [];
}

?>
<?php $this->beginContent('@app/views/layouts/layout.php'); ?>

<?php
NavBar::begin([
    'brandLabel' => Yii::$app->name,
    'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],
]);
//todo Update links
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right'],
    'activateParents' => true,
    'items' => array_filter([
        ['label' => 'Новости', 'url' => ['#']],
        ['label' => 'О сайте', 'url' => ['#']],
        ['label' => 'Контакты', 'url' => ['#']],
        [
            'label' => 'Администрирование',
            'items' => MenuItems::createArray(),
        ],
        [
            'label' => '<заглушка> Текущий юзер',
            'items' => [
                ['label' => 'Мои турниры', 'url' => ['/#']],
                '<li class="divider"></li>',
                ['label' => 'Профиль', 'url' => ['/#']],
            ],
        ],
        ['label' => 'Выход', 'url' => ['/user/default/logout'], 'linkOptions' => ['data-method' => 'post']]
    ]),
]);
NavBar::end();
?>

    <div class="container">
            <?= Breadcrumbs::widget([
                'links' => ArrayHelper::merge($panelBreadcrumbs, $breadcrumbs),
            ]) ?>
        <?= AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_ALERT,
        ]) ?>
        <?= $content ?>
    </div>

<?php $this->endContent(); ?>
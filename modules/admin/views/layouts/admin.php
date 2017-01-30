<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/24/2017
 * Time: 4:56 PM
 */
use kartik\alert\AlertBlock;
use kartik\growl\Growl;
use app\modules\admin\resources\AdminMenuItems;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

/** @var \yii\web\Controller $context */

$context = $this->context;

if (isset($this->params['breadcrumbs'])) {
    $panelBreadcrumbs = [['label' => 'Панель администратора', 'url' => ['/admin/default/']]];
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
        ['label' => 'Новости', 'url' => ['/#']],
        ['label' => 'О сайте', 'url' => ['/#']],
        ['label' => 'Контакты', 'url' => ['/#']],
        [
            'label' => 'Администрирование',
            'items' => AdminMenuItems::dropDownMenuItems(),
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

    <div class="container-fluid" style="padding-top: 70px">
        <div class = "row">
            <?= Breadcrumbs::widget([
                    'options' => [
                        'class' => 'col-xs-12 col-xs-offset-0 col-sm-offset-1 col-sm-10 breadcrumb',
                    ],
                    'links' => ArrayHelper::merge($panelBreadcrumbs, $breadcrumbs),
                ]) ?>
        </div>

        <?= AlertBlock::widget([
            'useSessionFlash' => true,
            'type' => AlertBlock::TYPE_GROWL,
            'alertSettings' => [
                'error' => [
                    'pluginOptions' => [
                        'placement' => ['align' => 'left'],
                    ],
                    'type' => Growl::TYPE_DANGER,
                    'icon' => 'glyphicon glyphicon-flag',
                ],
                'success' => [
                    'pluginOptions' => [
                        'placement' => ['align' => 'left'],
                    ],
                    'type' => Growl::TYPE_SUCCESS,
                    'icon' => 'glyphicon glyphicon-ok-sign',
                ],
                'info' => ['pluginOptions' => ['placement' => ['align' => 'left']], 'type' => Growl::TYPE_INFO],
                'warning' => ['pluginOptions' => ['placement' => ['align' => 'left']], 'type' => Growl::TYPE_WARNING],
                'growl' => ['pluginOptions' => ['placement' => ['align' => 'left']], 'type' => Growl::TYPE_GROWL],
            ]
        ]) ?>

        <div class = "row">
            <div class = "col-xs-12 col-xs-offset-0 col-sm-offset-1 col-sm-10">
                <?= $content ?>
            </div>
        </div>
    </div>

<?php $this->endContent(); ?>
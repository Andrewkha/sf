<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/24/2017
 * Time: 4:55 PM
 */

use kartik\helpers\Html;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body style ="padding-top: 80px;">

    <?php $this->beginBody() ?>
    <div class="wrap">
        <?= $content ?>
    </div>

    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    <p class="pull-left">&copy; <?= Html::encode(Yii::$app->params['webStudioName']) . ' :) ' . date('Y') ?></p>
                </div>
            </div>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>
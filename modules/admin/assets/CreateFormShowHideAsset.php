<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/30/2017
 * Time: 2:23 PM
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class CreateFormShowHideAsset extends AssetBundle
{
    public $sourcePath = '@admin/scripts';

    public $js = [
        'js/CreateFormShowHide.js'
    ];

    public $css = [
        'css/CreateFormShowHide.css'
    ];
}
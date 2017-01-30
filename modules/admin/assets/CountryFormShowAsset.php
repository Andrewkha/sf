<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/30/2017
 * Time: 2:23 PM
 */

namespace app\modules\admin\assets;

use yii\web\AssetBundle;

class CountryFormShowAsset extends AssetBundle
{
    public $sourcePath = '@admin/scripts';

    public $js = [
        'js/CountryFormShow.js'
    ];

    public $css = [
        'css/CountryFormShow.css'
    ];
}
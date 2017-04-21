<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/21/2017
 * Time: 1:34 PM
 */

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $body string */
/* @var $user \app\models\User */
?>

<div class="row">.
    <table width="100%" align="center">
        <tr bgcolor="#8a8a8a">
            <td style = "padding:10px">
                <table align="center" width="40%">
                    <tr >
                        <td>
                            <?= Html::img($message->embed($logo), ['width' => 70]);?>
                        </td>
                        <td align="right">
                            <h4>Сайт Спортивных Прогнозов</h4>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table align="center" width="40%">
        <tr>
            <td style="font-size:16px: line-height:16px;" height="16px"></td>
        </tr>

        <tr>
            <td>
                <h2 style="font-size: 20px;"><?=$user->username?>,</h2>
                <p class="lead" style="font-size: 16px;"><?= $body?>
            </td>
        </tr>
    </table>
</div>

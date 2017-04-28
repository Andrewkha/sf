<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/28/2017
 * Time: 3:33 PM
 */
use kartik\helpers\Html;

/* @var $this yii\web\View */
/* @var $tournament \app\modules\admin\models\Tournament */
/* @var $user \app\models\User */
/* @var $standings string */
/* @var $winners string */
/* @var $allForecasters \app\resources\dto\ForecastStandingsItem[] */
/** @var $usersPositions array */

?>

<div class="row">
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
                <?php if ($usersPositions[$user->id] == 1) :?>
                    <p class="lead" style="font-size: 16px;">
                        Поздравляем!!! Набрав <strong><?= $allForecasters[0]->totalPoints;?> очков</strong>, Вы стали победителем конкурса прогнозов в турнире <?= $tournament->tournament;?>
                    </p>
                <?php else: ?>
                    <p class="lead" style="font-size: 16px;">
                        Набрав <strong><?= $allForecasters[$usersPositions[$user->id] - 1]->totalPoints;?> очков</strong> Вы заняли <?= $usersPositions[$user->id] ;?> место в конкурсе прогнозов в турнире <?= $tournament->tournament;?>
                    </p>
                <?php endif;?>
                <p>
                    Из них <strong><?= $allForecasters[$usersPositions[$user->id] - 1]->totalPoints - $allForecasters[$usersPositions[$user->id] - 1]->winnersForecastResult['totalPoints']->eventPoints;?> очков</strong> начислено за угаданные исходы матчей, дополнительные <strong><?= $allForecasters[$usersPositions[$user->id] - 1]->winnersForecastResult['totalPoints']->eventPoints;?> очков</strong> - за прогноз на победителей турнира.
                </p>
                <p>
                    Детальная информация по дополнительным очкам:
                </p>
                <?php foreach ($allForecasters[$usersPositions[$user->id] - 1]->winnersForecastResult as $one):?>
                    <ul>
                        <?php if ($one->eventCode != \app\modules\admin\resources\winnersForecastCalculator\StandardWinnersForecastCalculator::WFE_TOTAL_POINTS) :?>
                            <li><?= $one->eventMessage . $one->eventPoints;?></li>
                        <?php endif;?>
                    </ul>
                <?php endforeach;?>
            </td>
        </tr>

        <tr>
            <td>
                <?= $winners; ?>
            </td>
        </tr>
        <tr>
            <td>
                <?= $standings; ?>
            </td>
        </tr>
    </table>
</div>

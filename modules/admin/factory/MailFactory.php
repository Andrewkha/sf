<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 17.03.2017
 * Time: 16:07
 */

namespace app\modules\admin\factory;

use app\modules\admin\services\MailService;
use Yii;
use app\modules\user\models\User;
use yii\data\ArrayDataProvider;
use app\modules\admin\models\Tournament;

class MailFactory
{
    public static function makeForecastReminderEmptyMailerService(User $user, $games, $firstGame, $tour,  Tournament $tournament)
    {
        $to = $user->email;
        $from = [Yii::$app->params['adminEmail'] => Yii::$app->params['adminTitle']];
        $subject = "Напоминание: сделайте прогноз на матчи $tour тура турнира $tournament->tournament";
        $params = [
            'user' => $user,
            'logo' => Yii::$app->params['logo'],
            'games' => new ArrayDataProvider(['allModels' => $games]),
            'firstGame' => $firstGame,
            'tour' => $tour,
            'tournament' => $tournament,
        ];

        return self::makeMailerService($from, $to, $subject, 'remindEmpty', $params);
    }

    public static function makeForecastReminderPartialMailerService(User $user, $games, $firstGame, $tour,  Tournament $tournament)
    {
        $to = $user->email;
        $from = [Yii::$app->params['adminEmail'] => Yii::$app->params['adminTitle']];
        $subject = "Напоминание: сделайте прогноз на матчи $tour тура турнира $tournament->tournament";
        $params = [
            'user' => $user,
            'logo' => Yii::$app->params['logo'],
            'games' => new ArrayDataProvider(['allModels' => $games]),
            'firstGame' => $firstGame,
            'tour' => $tour,
            'tournament' => $tournament,
        ];

        return self::makeMailerService($from, $to, $subject, 'remindPartial', $params);
    }

    public static function makeMailerService($from, $to, $subject, $view, array $params = [])
    {
        return Yii::$container->get(MailService::class, [$from, $to, $subject, $view, $params, Yii::$app->getMailer()]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 17.03.2017
 * Time: 16:07
 */

namespace app\modules\admin\factory;

use app\modules\admin\models\Newz;
use app\modules\admin\services\MailService;
use app\modules\admin\services\MailServiceMultiple;
use app\modules\admin\models\Game;
use Yii;
use app\modules\user\models\User;
use yii\data\ArrayDataProvider;
use app\modules\admin\models\Tournament;
use yii\helpers\ArrayHelper;

class MailFactory
{
    /**
     * @param User[] $users
     * @param Game[] $games
     * @param $firstGame
     * @param $tour
     * @param Tournament $tournament
     * @return MailServiceMultiple
     */
    public static function makeForecastReminderEmptyMailerService(array $users, $games, $firstGame, $tour,  Tournament $tournament)
    {
        $to = $users;
        $from = [Yii::$app->params['adminEmail'] => Yii::$app->params['adminTitle']];
        $subject = "Напоминание: сделайте прогноз на матчи $tour тура турнира $tournament->tournament";
        $params = [
            'logo' => Yii::$app->params['logo'],
            'games' => new ArrayDataProvider(['allModels' => $games]),
            'firstGame' => $firstGame,
            'tour' => $tour,
            'tournament' => $tournament,
        ];

        return self::makeMailerServiceMultiple($from, $to, $subject, 'remindEmpty', $params);
    }

    /**
     * @param User[] $users
     * @param Game[] $games
     * @param $firstGame
     * @param $tour
     * @param Tournament $tournament
     * @return MailServiceMultiple
     */
    public static function makeForecastReminderPartialMailerService(array $users, $games, $firstGame, $tour,  Tournament $tournament)
    {
        $to = $users;
        $from = [Yii::$app->params['adminEmail'] => Yii::$app->params['adminTitle']];
        $subject = "Напоминание: сделайте прогноз на матчи $tour тура турнира $tournament->tournament";
        $params = [
            'logo' => Yii::$app->params['logo'],
            'games' => new ArrayDataProvider(['allModels' => $games]),
            'firstGame' => $firstGame,
            'tour' => $tour,
            'tournament' => $tournament,
        ];

        return self::makeMailerServiceMultiple($from, $to, $subject, 'remindPartial', $params);
    }

    /**
     * @param User[] $users
     * @param Newz $news
     * @return MailServiceMultiple
     */
    public static function makeNewsSendMailerService(array $users, Newz $news)
    {
        $to = $users;
        $from = [Yii::$app->params['adminEmail'] => Yii::$app->params['adminTitle']];
        $subject = $news->getNewzCategory() . ' - ' . $news->subject;
        $params = [
            'logo' => Yii::$app->params['logo'],
            'body' => $news->body,
        ];

        return self::makeMailerServiceMultiple($from, $to, $subject, 'news', $params);
    }

    public static function makeMailerService($from, $to, $subject, $view, array $params = [])
    {
        return Yii::$container->get(MailService::class, [$from, $to, $subject, $view, $params, Yii::$app->getMailer()]);
    }

    public static function makeMailerServiceMultiple($from, array $to, $subject, $view, array $params = [])
    {
        return Yii::$container->get(MailServiceMultiple::class, [$from, $to, $subject, $view, $params, Yii::$app->getMailer()]);
    }
}
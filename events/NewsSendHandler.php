<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/21/2017
 * Time: 1:03 PM
 */

namespace app\events;


use app\modules\admin\models\Newz;
use app\modules\user\models\query\UserQuery;
use app\modules\admin\factory\MailFactory;
use app\traits\ContainerAwareTrait;
use yii\base\Exception;

class NewsSendHandler
{
    use ContainerAwareTrait;

    /** @var UserQuery */
    protected $userQuery;

    public function __construct()
    {
        $this->userQuery = $this->make(UserQuery::class);
    }

    public function newsSendHandle(Newz $news)
    {
        if ($news->tournament_id == 0) {
            $users = $this->userQuery->siteNewsSubscribers()->all();
        } else {
            $users = $this->userQuery->tournamentNotificationsSubscribers($news->tournament_id)->all();
        }

        if (!empty($users)) {
            $mailService = MailFactory::makeNewsSendMailerService($users, $news);

            if ($mailService->run() !== count($users))
                throw new Exception("Ошибка отправки новости ". $news->id);
        }
    }
}
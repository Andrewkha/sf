<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 21.03.2017
 * Time: 18:00
 */

namespace app\modules\admin\services;

use yii\mail\BaseMailer;
use Yii;
use app\modules\user\models\User;

class MailServiceMultiple extends MailService
{
    /**
     * @var User[]
     */
    protected $to = [];

    public function __construct($from, array $to, $subject, $view, array $params, BaseMailer $mailer)
    {
        $this->from = $from;
        $this->to = $to;
        $this->subject = $subject;
        $this->view = $view;
        $this->params = $params;
        $this->mailer = $mailer;
        $this->mailer->setViewPath($this->viewPath);
        $this->mailer->getView()->theme = Yii::$app->view->theme;
    }

    public function run() {

        $messages = [];
        foreach ($this->to as $one) {
            $this->params['user'] = $one;
            $messages[] = $this->mailer
                ->compose($this->view, $this->params)
                ->setFrom($this->from)
                ->setTo($one->email)
                ->setSubject($this->subject);
        }

        return $this->mailer->sendMultiple($messages);
    }
}
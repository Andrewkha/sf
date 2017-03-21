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

class MailServiceMultiple extends MailService
{
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

        return $this->mailer
            ->compose($this->view, $this->params)
            ->setFrom($this->from)
            ->setTo($this->to)
            ->setSubject($this->subject)
            ->send();
    }
}
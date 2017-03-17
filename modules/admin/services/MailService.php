<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 17.03.2017
 * Time: 15:04
 */

namespace app\modules\admin\services;

use app\modules\admin\contracts\ServiceInterface;
use yii\mail\BaseMailer;
use Yii;

class MailService implements ServiceInterface
{
    protected $viewPath = '@admin/views/mail';

    protected $from;
    protected $to;
    protected $subject;
    protected $view;
    protected $params = [];
    protected $mailer;


    public function __construct($from, $to, $subject, $view, array $params, BaseMailer $mailer)
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

    public function setViewParam($name, $value)
    {
        $this->params[$name] = $value;
        return $this;
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
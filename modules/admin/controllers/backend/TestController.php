<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/25/2017
 * Time: 3:20 PM
 */

namespace app\modules\admin\controllers\backend;

use app\modules\admin\models\Tournament;
use app\modules\admin\Module;
use app\resources\ForecastStandingsInterface;
use yii\web\Controller;
use Yii;

class TestController extends Controller
{

    protected $standings;

    public function __construct($id, Module $module, ForecastStandingsInterface $standings, array $config = [])
    {
        $this->standings = $standings;
        parent::__construct($id, $module, $config);
    }

    public function actionTest()
    {
        $tournament = Tournament::findOne(12);
        //$standings = $this->standings->getWinners($tournament);

        return $this->render('../newsTemplates/tournamentFinished', ['tournament' => $tournament]);
    }
}
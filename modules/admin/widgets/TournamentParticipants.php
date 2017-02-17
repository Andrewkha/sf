<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/17/2017
 * Time: 3:54 PM
 */

namespace app\modules\admin\widgets;


use app\modules\admin\models\query\TeamQuery;
use app\modules\admin\models\query\TeamTournamentQuery;
use app\modules\admin\models\Tournament;
use kartik\base\Widget;
use yii\helpers\ArrayHelper;

/**
 * Class TournamentParticipants
 * @package app\modules\admin\widgets
 *
 * @property Tournament $tournament
 */
class TournamentParticipants extends Widget
{
    public $tournament;
    protected $teamTournamentQuery;
    protected $teamQuery;
    protected $candidates;
    protected $participants;

    public function __construct(TeamQuery $teamQuery, TeamTournamentQuery $teamTournamentQuery, array $config = [])
    {
        $this->teamTournamentQuery = $teamTournamentQuery;
        $this->teamQuery = $teamQuery;
        parent::__construct($config);
    }

    public function run()
    {
        $this->getParticipants();
        $this->getCandidates();

        return $this->render('/widgets/addParticipants', ['candidates' => $this->candidates]);
    }

    protected function getCandidates()
    {
        $this->candidates = $this->teamQuery
            ->whereCountry($this->tournament->country_id)
            ->andWhere(['not in', 'id', ArrayHelper::getColumn($this->participants, 'team_id')])
            ->orderBy(['team' => SORT_ASC])
            ->all();
    }

    protected function getParticipants()
    {
        $this->participants = $this->teamTournamentQuery
            ->tournamentParticipants($this->tournament->id)
            ->joinWith('team')
            ->orderBy(['team' => SORT_ASC])
            ->all();
    }
}
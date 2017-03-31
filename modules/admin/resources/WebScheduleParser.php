<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 31.03.2017
 * Time: 16:22
 */

namespace app\modules\admin\resources;

use app\modules\admin\models\Tournament;
use app\modules\admin\resources\gameCalculator\PlayOffCalculator;
use app\modules\admin\resources\parser\ChampionatPlayOffParser;
use app\modules\admin\resources\parser\ChampionatStandardParser;
use app\modules\admin\resources\parser\ParserInterface;
use app\modules\admin\resources\parser\SportsPlayOffParser;
use app\modules\admin\resources\parser\SportsStandardParser;
use app\traits\ContainerAwareTrait;

class WebScheduleParser
{
    use ContainerAwareTrait;

    /** @var  Tournament */
    protected $tournament;

    /** @var  ParserInterface */
    protected $parser;

    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->parser = self::getParser();
    }

    protected function getParser()
    {
        if (stripos($this->tournament->autoprocessURL, 'sports') !== false && $this->tournament->isRegular())
            return $this->make(SportsStandardParser::class);

        if (stripos($this->tournament->autoprocessURL, 'sports') !== false && $this->tournament->isPlayoff())
            return$this->make(SportsPlayOffParser::class);

        if (stripos($this->tournament->autoprocessURL, 'championat') !== false && $this->tournament->isRegular())
            return $this->make(ChampionatStandardParser::class);

        if (stripos($this->tournament->autoprocessURL, 'championat') !== false && $this->tournament->isPlayoff())
            return $this->make(ChampionatPlayOffParser::class);

        throw new \yii\base\Exception('Некорректный тип турнира');
    }

    public function getGamesFromWeb()
    {
        return $this->parser->getGamesFromWeb($this->tournament);
    }
}
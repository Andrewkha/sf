<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 2/27/2017
 * Time: 4:22 PM
 */

namespace app\resources\dto;


class Match
{
    const GAME_WIN = 'win';
    const GAME_LOSE = 'lose';
    const GAME_DRAW = 'draw';

    public $tour;
    public $date;
    public $scored;
    public $missed;
    public $outcome;
    public $title;

    public function __construct($tour, $date, $scored, $missed, $title)
    {
        $this->tour = $tour;
        $this->date = $date;
        $this->scored = $scored;
        $this->missed = $missed;
        $this->title = $title;
    }
}
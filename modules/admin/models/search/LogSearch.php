<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/7/2017
 * Time: 3:37 PM
 */

namespace app\modules\admin\models\search;

use app\modules\admin\models\Log;
use yii\data\ActiveDataProvider;

class LogSearch extends Log
{

    public function rules()
    {
        return [
            [['level', 'log_time'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Log::find()->indexBy('id')->where(['category' => self::CATEGORY_CONSOLE]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['log_time' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'level' => $this->level,
            'category' => $this->category,
        ]);

        $query->andFilterWhere(['between', 'log_time', $this->toTimeStamp()['from'], $this->toTimeStamp()['to']]);

        return $dataProvider;
    }

    private function toTimeStamp()
    {
        $result = [];

        $stamp = $this->log_time;

        if ($stamp === NULL or $stamp === '') {
            return ['from' => NULL, 'to' => NULL];
        }

        $day = (int)substr($stamp, 0, 2);
        $month = (int)substr($stamp, 3, 2);
        $year = (int)substr($stamp, 6, 4);

        $result['from'] = mktime(0, 0 , 0, $month, $day, $year);
        $result['to'] = mktime(23, 59 , 59, $month, $day, $year);

        return $result;
    }
}
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


        return $dataProvider;
    }
}
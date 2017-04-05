<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 4/5/2017
 * Time: 12:20 PM
 */

namespace app\modules\admin\models\search;

use app\modules\admin\models\Newz;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NewzSearch extends Newz
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tournament_id', 'date', 'status'], 'integer'],
            [['subject', 'body'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Newz::find()
            ->joinWith(['user'])
            ->indexBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'date' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'tournament_id' => [
                        'asc' => ['{{%tournament.tournament}}' => SORT_ASC],
                        'desc' => ['{{%tournament.tournament}}' => SORT_DESC]
                    ],
                    'user_id',
                    'date',
                    'status'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['user', 'tournament']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'tournament_id' => $this->tournament_id,
            'status' => $this->status
        ]);

        return $dataProvider;
    }
}
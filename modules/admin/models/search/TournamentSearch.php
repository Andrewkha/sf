<?php

namespace app\modules\admin\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Tournament;

/**
 * TournamentSearch represents the model behind the search form about `app\modules\admin\models\Tournament`.
 */
class TournamentSearch extends Tournament
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'country_id', 'type', 'tours', 'status', 'starts', 'autoprocess', 'winnersForecastDue'], 'integer'],
            [['tournament', 'logo', 'autoprocessURL'], 'safe'],
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
        $query = Tournament::find()
            ->joinWith('country')
            ->indexBy('id');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'starts' => SORT_DESC,
                ],
                'attributes' => [
                    'id',
                    'country_id' => [
                        'asc' => ['{{%country}}.country' => SORT_ASC],
                        'desc' => ['{{%country}}.country' => SORT_DESC]
                    ],
                    'tournament',
                    'starts'
                ]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            $query->joinWith(['country']);
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'country_id' => $this->country_id,
            'type' => $this->type,
            'tours' => $this->tours,
            'status' => $this->status,
            'starts' => $this->starts,
            'autoprocess' => $this->autoprocess,
            'winnersForecastDue' => $this->winnersForecastDue,
        ]);

        $query->andFilterWhere(['like', 'tournament', $this->tournament])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'autoprocessURL', $this->autoprocessURL]);

        return $dataProvider;
    }
}

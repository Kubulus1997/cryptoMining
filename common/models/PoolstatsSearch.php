<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Poolstats;

/**
 * PoolstatsSearch represents the model behind the search form about `common\models\Poolstats`.
 */
class PoolstatsSearch extends Poolstats
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_number'], 'integer'],
            [['miner', 'time'], 'safe'],
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
        $query = Poolstats::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'block_number' => $this->block_number,
            'time' => $this->time,
        ]);

        $query->andFilterWhere(['like', 'miner', $this->miner]);

        return $dataProvider;
    }
}

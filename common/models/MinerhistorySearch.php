<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Minerhistory;

/**
 * MinerhistorySearch represents the model behind the search form about `\common\models\Minerhistory`.
 */
class MinerhistorySearch extends Minerhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'average_hashrate', 'active_workers'], 'integer'],
            [['time'], 'safe'],
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
        $query = Minerhistory::find();

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
            'id' => $this->id,
            'time' => $this->time,
            'current_hashrate' => $this->current_hashrate,
            'valid_shares' => $this->valid_shares,
            'invalid_shares' => $this->invalid_shares,
            'stale_shares' => $this->stale_shares,
            'average_hashrate' => $this->average_hashrate,
            'active_workers' => $this->active_workers,
        ]);

        return $dataProvider;
    }
}

<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Workerhistory;

/**
 * WorkerhistorySearch represents the model behind the search form about `common\models\Workerhistory`.
 */
class WorkerhistorySearch extends Workerhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_seen'], 'safe'],
            [['reported_hashrate', 'average_hashrate', 'current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'gpu_id', 'id'], 'integer'],
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
        $query = Workerhistory::find();

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
            'last_seen' => $this->last_seen,
            'reported_hashrate' => $this->reported_hashrate,
            'average_hashrate' => $this->average_hashrate,
            'current_hashrate' => $this->current_hashrate,
            'valid_shares' => $this->valid_shares,
            'invalid_shares' => $this->invalid_shares,
            'stale_shares' => $this->stale_shares,
            'gpu_id' => $this->gpu_id,
            'id' => $this->id,
        ]);

        return $dataProvider;
    }
}

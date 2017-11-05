<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "miner_history".
 *
 * @property integer $id
 * @property string $time
 * @property integer $current_hashrate
 * @property integer $valid_shares
 * @property integer $invalid_shares
 * @property integer $stale_shares
 * @property integer $average_hashrate
 * @property integer $active_workers
 */
class Minerhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'miner_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'average_hashrate', 'active_workers'], 'required'],
            [['time'], 'safe'],
            [['current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'average_hashrate', 'active_workers'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'current_hashrate' => 'Current Hashrate',
            'valid_shares' => 'Valid Shares',
            'invalid_shares' => 'Invalid Shares',
            'stale_shares' => 'Stale Shares',
            'average_hashrate' => 'Average Hashrate',
            'active_workers' => 'Active Workers',
        ];
    }

    /**
     * @inheritdoc
     * @return MinerHistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MinerhistoryQuery(get_called_class());
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "worker_history".
 *
 * @property string $last_seen
 * @property integer $reported_hashrate
 * @property integer $average_hashrate
 * @property integer $current_hashrate
 * @property integer $valid_shares
 * @property integer $invalid_shares
 * @property integer $stale_shares
 * @property integer $gpu_id
 * @property integer $id
 *
 * @property Gpu $gpu
 */
class workerhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'worker_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_seen', 'reported_hashrate', 'average_hashrate', 'current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'gpu_id'], 'required'],
            [['last_seen'], 'safe'],
            [['reported_hashrate', 'average_hashrate', 'current_hashrate', 'valid_shares', 'invalid_shares', 'stale_shares', 'gpu_id'], 'integer'],
            [['gpu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gpu::className(), 'targetAttribute' => ['gpu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'last_seen' => 'Last Seen',
            'reported_hashrate' => 'Reported Hashrate',
            'average_hashrate' => 'Average Hashrate',
            'current_hashrate' => 'Current Hashrate',
            'valid_shares' => 'Valid Shares',
            'invalid_shares' => 'Invalid Shares',
            'stale_shares' => 'Stale Shares',
            'gpu_id' => 'Gpu ID',
            'id' => 'ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGpu()
    {
        return $this->hasOne(Gpu::className(), ['id' => 'gpu_id']);
    }

    /**
     * @inheritdoc
     * @return MinerhistoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MinerhistoryQuery(get_called_class());
    }
}

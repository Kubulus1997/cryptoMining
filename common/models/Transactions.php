<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $id
 * @property string $time
 * @property integer $block_number
 * @property integer $user_id
 * @property integer $current_hashrate
 * @property integer $amount
 * @property integer $address
 * @property string $type
 * @property string $tx_hash
 * @property integer $gpu_id
 *
 * @property Gpu $gpu
 * @property User $user
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['time', 'block_number', 'current_hashrate', 'amount', 'type', 'gpu_id'], 'required'],
            [['time'], 'safe'],
            [['block_number', 'user_id', 'current_hashrate', 'amount', 'address', 'gpu_id'], 'integer'],
            [['type', 'tx_hash'], 'string'],
            [['gpu_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gpu::className(), 'targetAttribute' => ['gpu_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'block_number' => 'Block Number',
            'user_id' => 'User ID',
            'current_hashrate' => 'Current Hashrate',
            'amount' => 'Amount',
            'address' => 'Address',
            'type' => 'Type',
            'tx_hash' => 'Tx Hash',
            'gpu_id' => 'Gpu ID',
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return TransactionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TransactionsQuery(get_called_class());
    }
}

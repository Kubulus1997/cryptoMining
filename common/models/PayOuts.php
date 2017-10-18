<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pay_outs".
 *
 * @property integer $id
 * @property integer $start_block
 * @property integer $end_block
 * @property integer $amount
 * @property string $tx_hash
 * @property string $paid_on
 */
class PayOuts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pay_outs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'start_block', 'end_block', 'amount', 'tx_hash'], 'required'],
            [['id', 'start_block', 'end_block', 'amount'], 'integer'],
            [['paid_on'], 'safe'],
            [['tx_hash'], 'string', 'max' => 255],
            [['tx_hash'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_block' => 'Start Block',
            'end_block' => 'End Block',
            'amount' => 'Amount',
            'tx_hash' => 'Tx Hash',
            'paid_on' => 'Paid On',
        ];
    }

    /**
     * @inheritdoc
     * @return PayOutsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PayOutsQuery(get_called_class());
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "pool_stats".
 *
 * @property integer $block_number
 * @property string $miner
 * @property string $time
 */
class Poolstats extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pool_stats';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['block_number', 'time'], 'required'],
            [['block_number'], 'integer'],
            [['miner'], 'string'],
            [['time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'block_number' => 'Block Number',
            'miner' => 'Miner',
            'time' => 'Time',
        ];
    }

    /**
     * @inheritdoc
     * @return PoolstatsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PoolstatsQuery(get_called_class());
    }
}

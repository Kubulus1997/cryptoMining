<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gpu".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $gpu_name
 */
class gpu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gpu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gpu_name'], 'required'],
            [['member_id'], 'integer'],
            [['gpu_name'], 'string', 'max' => 255],
            [['gpu_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member_id' => 'Member Id',
            'gpu_name' => 'Gpu Name',
        ];
    }

    /**
     * @inheritdoc
     * @return GpuQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GpuQuery(get_called_class());
    }
}

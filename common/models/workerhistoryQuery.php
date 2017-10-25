<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[workerhistory]].
 *
 * @see workerhistory
 */
class workerhistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return workerhistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return workerhistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

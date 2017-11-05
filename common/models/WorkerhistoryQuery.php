<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Workerhistory]].
 *
 * @see Workerhistory
 */
class WorkerhistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Workerhistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Workerhistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

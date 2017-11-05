<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Poolstats]].
 *
 * @see Poolstats
 */
class PoolstatsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Poolstats[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Poolstats|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

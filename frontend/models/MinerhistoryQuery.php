<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Minerhistory]].
 *
 * @see Minerhistory
 */
class MinerhistoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Minerhistory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Minerhistory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[ChannelPackages]].
 *
 * @see ChannelPackages
 */
class ChannelPackagesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ChannelPackages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChannelPackages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[ChannelCategories]].
 *
 * @see ChannelCategories
 */
class ChannelCategoriesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ChannelCategories[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChannelCategories|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

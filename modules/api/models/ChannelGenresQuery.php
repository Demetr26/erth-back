<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[ChannelGenres]].
 *
 * @see ChannelGenres
 */
class ChannelGenresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ChannelGenres[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChannelGenres|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

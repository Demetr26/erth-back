<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[Genres]].
 *
 * @see Genres
 */
class GenresQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Genres[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Genres|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

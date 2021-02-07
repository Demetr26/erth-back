<?php

namespace app\modules\api\models;

/**
 * This is the ActiveQuery class for [[ChannelProgramm]].
 *
 * @see ChannelProgramm
 */
class ChannelProgrammQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ChannelProgramm[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ChannelProgramm|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

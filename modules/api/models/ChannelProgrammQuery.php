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

    public function date( $date ){
        $this->andWhere("[[date]]=:date",['date' => $date]);
    }

    public function channel( $channel_id ){
        $this->andWhere("[[channel_id]]=:channel_id",['channel_id' => $channel_id]);
    }

    public function categories( $categories_id ){
        $channels = ChannelCategories::find()->select('channel_id')->andFilterCompare('category_id',$categories_id)->column();
        if($channels)
            $this->andWhere("[[channel_id]]=:channel_id",['channel_id' => $channels]);
    }
}

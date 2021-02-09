<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "channel_categories".
 *
 * @property int $id
 * @property int $channel_id
 * @property int $category_id
 *
 * @property Channels $channel
 * @property Categories $category
 */
class ChannelCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'category_id'], 'required'],
            [['channel_id', 'category_id'], 'integer'],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channels::className(), 'targetAttribute' => ['channel_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel_id' => 'Channel ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * Gets query for [[Channel]].
     *
     * @return \yii\db\ActiveQuery|ChannelsQuery
     */
    public function getChannel()
    {
        return $this->hasOne(Channels::className(), ['id' => 'channel_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery|CategoriesQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * {@inheritdoc}
     * @return ChannelCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelCategoriesQuery(get_called_class());
    }
}

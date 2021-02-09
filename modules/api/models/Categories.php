<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $title Название категории
 *
 * @property ChannelCategories[] $channelCategories
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название категории',
        ];
    }

    /**
     * Gets query for [[ChannelCategories]].
     *
     * @return \yii\db\ActiveQuery|ChannelCategoriesQuery
     */
    public function getChannelCategories()
    {
        return $this->hasMany(ChannelCategories::className(), ['category_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriesQuery(get_called_class());
    }
}

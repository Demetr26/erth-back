<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "genres".
 *
 * @property int $id
 * @property string $title Название жанра
 *
 * @property ChannelGenres[] $channelGenres
 */
class Genres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres';
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
            'title' => 'Название жанра',
        ];
    }

    /**
     * Gets query for [[ChannelGenres]].
     *
     * @return \yii\db\ActiveQuery|ChannelGenresQuery
     */
    public function getChannelGenres()
    {
        return $this->hasMany(ChannelGenres::className(), ['genre_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return GenresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GenresQuery(get_called_class());
    }
}

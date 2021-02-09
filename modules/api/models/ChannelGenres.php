<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "channel_genres".
 *
 * @property int $id
 * @property int $channel_id
 * @property int $genre_id
 *
 * @property Channels $channel
 * @property Genres $genre
 */
class ChannelGenres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'genre_id'], 'required'],
            [['channel_id', 'genre_id'], 'integer'],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channels::className(), 'targetAttribute' => ['channel_id' => 'id']],
            [['genre_id'], 'exist', 'skipOnError' => true, 'targetClass' => Genres::className(), 'targetAttribute' => ['genre_id' => 'id']],
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
            'genre_id' => 'Genre ID',
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
     * Gets query for [[Genre]].
     *
     * @return \yii\db\ActiveQuery|GenresQuery
     */
    public function getGenre()
    {
        return $this->hasOne(Genres::className(), ['id' => 'genre_id']);
    }

    /**
     * {@inheritdoc}
     * @return ChannelGenresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelGenresQuery(get_called_class());
    }
}

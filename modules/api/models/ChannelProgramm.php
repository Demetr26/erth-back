<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "channel_programm".
 *
 * @property int $id
 * @property int $channel_id
 * @property string $date Дата показана программы
 * @property string $time_start
 * @property string $time_end
 * @property string $title
 * @property int $genre_id
 *
 * @property Channels $channel
 */
class ChannelProgramm extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_programm';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'date', 'time_start', 'time_end', 'title'], 'required'],
            [['channel_id','genre_id'], 'integer'],
            [['date', 'time_start', 'time_end'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channels::className(), 'targetAttribute' => ['channel_id' => 'id']],
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
            'date' => 'Дата показана программы',
            'time_start' => 'Time Start',
            'time_end' => 'Time End',
            'title' => 'Title',
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
     * {@inheritdoc}
     * @return ChannelProgrammQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelProgrammQuery(get_called_class());
    }
}

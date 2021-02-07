<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "channels".
 *
 * @property int $id
 * @property string $title Наименование канала
 * @property int|null $is_hd Является ли HD каналом
 * @property string $logo Ссылка на логотип
 * @property string|null $age_restriction Возрастное ограничение канала
 *
 * @property ChannelCategories[] $channelCategories
 * @property ChannelGenres[] $channelGenres
 * @property ChannelPackages[] $channelPackages
 * @property ChannelProgramm[] $channelProgramms
 */
class Channels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'logo'], 'required'],
            [['is_hd'], 'integer'],
            [['logo'], 'string'],
            [['title', 'age_restriction'], 'string', 'max' => 255],
            [['title'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Наименование канала',
            'is_hd' => 'Является ли HD каналом',
            'logo' => 'Ссылка на логотип',
            'age_restriction' => 'Возрастное ограничение канала',
        ];
    }

    /**
     * Gets query for [[ChannelCategories]].
     *
     * @return \yii\db\ActiveQuery|ChannelCategoriesQuery
     */
    public function getChannelCategories()
    {
        return $this->hasMany(ChannelCategories::className(), ['channel_id' => 'id']);
    }

    /**
     * Gets query for [[ChannelGenres]].
     *
     * @return \yii\db\ActiveQuery|ChannelGenresQuery
     */
    public function getChannelGenres()
    {
        return $this->hasMany(ChannelGenres::className(), ['channel_id' => 'id']);
    }

    /**
     * Gets query for [[ChannelPackages]].
     *
     * @return \yii\db\ActiveQuery|ChannelPackagesQuery
     */
    public function getChannelPackages()
    {
        return $this->hasMany(ChannelPackages::className(), ['channel_id' => 'id']);
    }

    /**
     * Gets query for [[ChannelProgramms]].
     *
     * @return \yii\db\ActiveQuery|ChannelProgrammQuery
     */
    public function getChannelProgramms()
    {
        return $this->hasMany(ChannelProgramm::className(), ['channel_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ChannelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelsQuery(get_called_class());
    }
}

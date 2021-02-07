<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "channel_packages".
 *
 * @property int $id
 * @property int $channel_id
 * @property int $package_id
 *
 * @property Channels $channel
 * @property Packages $package
 */
class ChannelPackages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'package_id'], 'required'],
            [['channel_id', 'package_id'], 'integer'],
            [['channel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Channels::className(), 'targetAttribute' => ['channel_id' => 'id']],
            [['package_id'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package_id' => 'id']],
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
            'package_id' => 'Package ID',
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
     * Gets query for [[Package]].
     *
     * @return \yii\db\ActiveQuery|PackagesQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package_id']);
    }

    /**
     * {@inheritdoc}
     * @return ChannelPackagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ChannelPackagesQuery(get_called_class());
    }
}

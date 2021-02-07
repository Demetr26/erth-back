<?php

namespace app\modules\api\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $title Название пакета
 * @property string $description Подробное описание пакета
 *
 * @property ChannelPackages[] $channelPackages
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description'], 'string', 'max' => 255],
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
            'title' => 'Название пакета',
            'description' => 'Подробное описание пакета',
        ];
    }

    /**
     * Gets query for [[ChannelPackages]].
     *
     * @return \yii\db\ActiveQuery|ChannelPackagesQuery
     */
    public function getChannelPackages()
    {
        return $this->hasMany(ChannelPackages::className(), ['package_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PackagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PackagesQuery(get_called_class());
    }
}

<?php

use yii\db\Migration;

/**
 * Class m210206_103149_channel_packages
 */
class m210206_103149_channel_packages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channel_packages', [
            'id' => $this->primaryKey(),
            'channel_id' => $this->integer()->notNull(),
            'package_id' => $this->integer()->notNull(),
        ]);

        // Channel_id FK
        $this->createIndex(
            'idx-channel_packages-channel_id',
            'channel_packages',
            'channel_id',
        );

        $this->addForeignKey(
            'fk-channel_packages-channel_id',
            'channel_packages',
            'channel_id',
            'channels',
            'id',
            'CASCADE',
        );

        // package_id FK
        $this->createIndex(
            'idx-channel_packages-package_id',
            'channel_packages',
            'package_id',
        );

        $this->addForeignKey(
            'fk-channel_packages-package_id',
            'channel_packages',
            'package_id',
            'packages',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('channel_packages','fk-channel_packages-package_id');
        $this->dropForeignKey('channel_packages','fk-channel_packages-channel_id');
        $this->dropIndex('channel_packages','idx-channel_packages-package_id');
        $this->dropIndex('channel_packages','idx-channel_packages-channel_id');
        $this->dropTable('channel_packages');
    }

}

<?php

use yii\db\Migration;

/**
 * Class m210206_103250_channel_categories
 */
class m210206_103250_channel_categories extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channel_categories', [
            'id' => $this->primaryKey(),
            'channel_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        // Channel_id FK
        $this->createIndex(
            'idx-channel_categories-channel_id',
            'channel_categories',
            'channel_id',
        );

        $this->addForeignKey(
            'fk-channel_categories-channel_id',
            'channel_categories',
            'channel_id',
            'channels',
            'id',
            'CASCADE',
        );

        // category_id FK
        $this->createIndex(
            'idx-channel_categories-category_id',
            'channel_categories',
            'category_id',
        );

        $this->addForeignKey(
            'fk-channel_categories-category_id',
            'channel_categories',
            'category_id',
            'categories',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('channel_categories','fk-channel_categories-category_id');
        $this->dropForeignKey('channel_categories','fk-channel_categories-channel_id');
        $this->dropIndex('channel_categories','idx-channel_categories-category_id');
        $this->dropIndex('channel_categories','idx-channel_categories-channel_id');
        $this->dropTable('channel_categories');
    }
}

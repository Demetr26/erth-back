<?php

use yii\db\Migration;

/**
 * Class m210206_103047_channel_genres
 */
class m210206_103150_channel_genres extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channel_genres', [
            'id' => $this->primaryKey(),
            'channel_id' => $this->integer()->notNull(),
            'genre_id' => $this->integer()->notNull(),
        ]);

        // Channel_id FK
        $this->createIndex(
            'idx-channel_genres-channel_id',
            'channel_genres',
            'channel_id',
        );

        $this->addForeignKey(
            'fk-channel_genres-channel_id',
            'channel_genres',
            'channel_id',
            'channels',
            'id',
            'CASCADE',
        );

        // package_id FK
        $this->createIndex(
            'idx-channel_genres-package_id',
            'channel_genres',
            'genre_id',
        );

        $this->addForeignKey(
            'fk-channel_genres-package_id',
            'channel_genres',
            'genre_id',
            'genres',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('channel_genres','fk-channel_genres-genre_id');
        $this->dropForeignKey('channel_genres','fk-channel_genres-channel_id');
        $this->dropIndex('channel_genres','idx-channel_genres-genre_id');
        $this->dropIndex('channel_genres','idx-channel_genres-channel_id');
        $this->dropTable('channel_genres');
    }

}

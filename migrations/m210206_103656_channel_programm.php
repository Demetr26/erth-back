<?php

use yii\db\Migration;

/**
 * Class m210206_103656_channel_programm
 */
class m210206_103656_channel_programm extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channel_programm', [
            'id' => $this->primaryKey(),
            'channel_id' => $this->integer()->notNull(),
            'date' => $this->date()->notNull()->comment('Дата показана программы'),
            'time_start' => $this->timestamp()->notNull(),
            'time_end' => $this->timestamp()->notNull(),
            'title' => $this->string()->notNull(),
            'genre_id' => $this->integer()->comment('Жанр передачи')
        ]);

        // Channel_id FK
        $this->createIndex(
            'idx-channel_programm-channel_id',
            'channel_programm',
            'channel_id',
        );

        $this->addForeignKey(
            'fk-channel_programm-channel_id',
            'channel_programm',
            'channel_id',
            'channels',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('channel_programm','fk-channel_programm-channel_id');
        $this->dropIndex('channel_programm','idx-channel_programm-channel_id');
        $this->dropTable('channel_programm');
    }

}

<?php

use yii\db\Migration;

/**
 * Class m210206_103129_genres
 */
class m210206_103129_genres extends Migration
{
    /**
     * Создание таблицы жанров
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('genres', [
           'id' => $this->primaryKey(),
           'title' => $this->text()->notNull()->comment('Название жанра'),
           'color' => $this->text()->notNull()->comment('Цвет для фильтрации'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('genres');
    }

}

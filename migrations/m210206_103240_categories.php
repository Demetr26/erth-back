<?php

use yii\db\Migration;

/**
 * Class m210206_103240_categories
 */
class m210206_103240_categories extends Migration
{
    /**
     * Создание таблицы категорий каналов
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'title' => $this->text()->notNull()->comment('Название категории'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('categories');
    }

}

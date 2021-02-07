<?php

use yii\db\Migration;

/**
 * Class m210206_102932_packages
 */
class m210206_102932_packages extends Migration
{
    /**
     * Создание таблицы пакетов каналов
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('packages',[
            'id' => $this->primaryKey(),
            'title' => $this->string()->unique()->notNull()->comment('Название пакета'),
            'description' => $this->string()->comment('Подробное описание пакета')->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('packages');
    }

}

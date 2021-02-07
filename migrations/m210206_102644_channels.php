<?php

use yii\db\Migration;

/**
 * Class m210206_102644_channels
 */
class m210206_102644_channels extends Migration
{
    /**
     * Создание таблицы каналов
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('channels',[
           'id' => $this->primaryKey(),
           'title' => $this->string()->comment('Наименование канала')->notNull()->unique(),
           'is_hd' => $this->smallInteger(1)->comment('Является ли HD каналом')->defaultValue(0),
           'logo' => $this->text()->comment('Ссылка на логотип')->notNull(),
           'age_restriction' => $this->string()->comment('Возрастное ограничение канала')->defaultValue(null),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('channels');
    }

}

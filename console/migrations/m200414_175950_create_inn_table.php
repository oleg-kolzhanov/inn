<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%inn}}`.
 */
class m200414_175950_create_inn_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%inn}}', [
            'id' => $this->primaryKey(),
            'value' =>$this->string()->notNull()->comment('ИНН'),
            'created_at' => $this->integer()->comment('Создано'),
            'updated_at' => $this->integer()->comment('Обновлено'),

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%inn}}');
    }
}

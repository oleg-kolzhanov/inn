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
            'value' =>$this->string(12)->notNull()->unique()->comment('ИНН'),
            'status' =>$this->boolean()->notNull()->comment('Статус'),
            'message' =>$this->string()->notNull()->comment('Сообщение'),
            'created_at' => $this->integer()->comment('Создано'),
            'updated_at' => $this->integer()->comment('Обновлено'),
        ]);

        $this->createIndex(
            '{{%idx-inn-value}}',
            '{{%inn}}',
            'value'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%inn}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m210407_151815_create_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $categories = ['Ever Given', 'Образование', 'Имперализм', 'Медицина', 'BLM', 'Патриарх Кирилл Московский', 'Северный поток'];

        foreach ($categories as $name) {
            $this->insert('{{%categories}}', ['name' => $name]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%categories}}');
    }
}

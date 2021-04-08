<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%objects}}`.
 */
class m210407_151816_create_objects_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%objects}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        $this->createIndex(
            'idx-post-category_id',
            '{{%objects}}',
            'category_id'
        );

        $this->addForeignKey(
            'fk-post-category_id',
            '{{%objects}}',
            'category_id',
            '{{%categories}}',
            'id',
            'CASCADE'
        );


        $this->insert('{{%objects}}', [
            'name' => 'client',
            'category_id' => 1
        ]);

        $this->insert('{{%objects}}', [
            'name' => 'human',
            'category_id' => 1
        ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%objects}}');
    }
}

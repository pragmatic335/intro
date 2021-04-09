<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%charge_types}}`.
 */
class m210407_161213_create_charge_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%charge_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $chargeTypes = ['Доход', 'Расход'];

        foreach ($chargeTypes as $name) {
            $this->insert('{{%charge_types}}', ['name' => $name]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%charge_types}}');
    }
}

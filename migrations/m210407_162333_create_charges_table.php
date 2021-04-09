<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%charges}}`.
 */
class m210407_162333_create_charges_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%charges}}', [
            'id' => $this->primaryKey(),
            'type_id' => $this->integer()->defaultValue(1),
            'object_id' => $this->integer()->notNull(),
            'currency_id' => $this->integer()->defaultValue(1),
            'sum' => $this->double(2)->notNull(),
            'createdate' => $this->date()->notNull(),
            'note' => $this->string(),

        ]);

        $this->createIndex(
            'idx-post-object_id',
            '{{%charges}}',
            'object_id'
        );

        $this->addForeignKey(
            'fk-post-object_id',
            '{{%charges}}',
            'object_id',
            '{{%objects}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-post-type_id',
            '{{%charges}}',
            'type_id',
            '{{%charge_types}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-post-currency_id',
            '{{%charges}}',
            'currency_id',
            '{{%currencies}}',
            'id',
            'CASCADE'
        );

        $chargers = [
            ['1','2', '1', rand(1,100), '01.01.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.02.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.03.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.04.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.05.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.06.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.07.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.08.2020', 'test'],
            ['2','2', '1', rand(1,100), '01.09.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.10.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.11.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.12.2020', 'test'],
            ['1','2', '1', rand(1,100), '01.01.2021', 'test'],
        ];

        foreach ($chargers as $charge) {
            $this->insert('{{%charges}}', [
                    'type_id' => $charge[0],
                    'object_id' => $charge[1],
                    'currency_id' => $charge[2],
                    'sum' => $charge[3],
                    'createdate' => $charge[4],
                    'note' => $charge[5]
                ]
            );
        }



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%charges}}');
    }
}

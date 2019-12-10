<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%store_product}}`.
 */
class m191209_164738_create_store_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%store_product}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'product_image' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%store_product}}');
    }
}

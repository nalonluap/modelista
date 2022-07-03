<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%model}}`.
 */
class m210609_174941_create_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%model}}', [
          'id' => $this->primaryKey(),
          'userId' => $this->integer(),
          'avatar' => $this->string(255),
          'categoryId' => $this->integer()->defaultValue(0),
          'city' => $this->string(255)->defaultValue('msc'),
          'gender' => $this->integer()->defaultValue(0),
          'hourPrice' => $this->integer()->defaultValue(0),
          'dayPrice' => $this->integer()->defaultValue(0),
          'age' => $this->integer()->defaultValue(18),
          'height' => $this->integer()->defaultValue(160),
          'weight' => $this->integer()->defaultValue(50),
          'shoes' => $this->integer()->defaultValue(0),
          // 'suit' => $this->integer()->defaultValue(0),
          'shirt' => $this->integer()->defaultValue(0),
          'bust' => $this->integer()->defaultValue(2),
          'ethnicity' => $this->integer()->defaultValue(0),
          'eyes' => $this->integer()->defaultValue(0),
          'hair' => $this->integer()->defaultValue(0),
          'tattoo' => $this->integer()->defaultValue(0),
          'instagram' => $this->string(255),
          'video' => $this->string(255),
          'digit_1' => $this->string(255),
          'digit_2' => $this->string(255),
          'digit_3' => $this->string(255),
          'digit_4' => $this->string(255),
          'pastClients' => $this->text(),
          'updated' => $this->datetime(),
          'created' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%model}}');
    }
}

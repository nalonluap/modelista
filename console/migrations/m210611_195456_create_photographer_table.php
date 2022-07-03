<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photographer}}`.
 */
class m210611_195456_create_photographer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photographer}}', [
          'id' => $this->primaryKey(),
          'userId' => $this->integer(),
          'avatar' => $this->string(255),
          'categoryId' => $this->integer()->defaultValue(0),
          'city' => $this->string(255)->defaultValue('msc'),
          'gender' => $this->integer()->defaultValue(0),
          'hourPrice' => $this->integer()->defaultValue(0),
          'dayPrice' => $this->integer()->defaultValue(0),
          'age' => $this->integer()->defaultValue(18),
          'instagram' => $this->string(255),
          'phone' => $this->string(255),
          'telegram' => $this->string(255),
          'whatsapp' => $this->string(255),
          'video' => $this->string(255),
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
        $this->dropTable('{{%photographer}}');
    }
}

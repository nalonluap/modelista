<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%model_image}}`.
 */
class m210610_130539_create_model_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%model_image}}', [
          'id' => $this->primaryKey(),
          'modelId' => $this->integer(),
          'image' => $this->string(255),
          'updated' => $this->datetime(), 
          'created' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%model_image}}');
    }
}

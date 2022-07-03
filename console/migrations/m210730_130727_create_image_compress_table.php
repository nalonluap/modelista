<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image_compress}}`.
 */
class m210730_130727_create_image_compress_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%image_compress}}', [
          'id' => $this->primaryKey(),
          'imgPath' => $this->string(),
          'done' => $this->boolean()->defaultValue(0),
          'error' => $this->string(),
          'inputSize' => $this->string(),
          'outputSize' => $this->string(),
          'diff' => $this->string(),
          'outputUrl' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%image_compress}}');
    }
}

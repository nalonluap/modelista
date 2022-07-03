<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%instagram_image}}`.
 */
class m210802_184934_create_instagram_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%instagram_image}}', [
          'id' => $this->primaryKey(),
          'userId' => $this->integer(),
          'instagramImageId' => $this->string(255),
          'image' => $this->string(255),
          'caption' => $this->text(),
          'permalink' => $this->string(255),
          'username' => $this->string(255),
          'timestamp' => $this->string(255),
          'created' => $this->datetime(),
          'updated' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%instagram_image}}');
    }
}

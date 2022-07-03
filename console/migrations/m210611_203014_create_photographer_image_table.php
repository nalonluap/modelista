<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%photographer_image}}`.
 */
class m210611_203014_create_photographer_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%photographer_image}}', [
            'id' => $this->primaryKey(),
            'photographerId' => $this->integer(),
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
        $this->dropTable('{{%photographer_image}}');
    }
}

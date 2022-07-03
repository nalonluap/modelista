<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%instagram_token}}`.
 */
class m210802_161623_create_instagram_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%instagram_token}}', [
          'id' => $this->primaryKey(),
          'userId' => $this->string(255),
          'token' => $this->string(255),
          'created' => $this->datetime(),
          'updated' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%instagram_token}}');
    }
}

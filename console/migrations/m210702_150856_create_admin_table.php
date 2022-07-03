<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%admin}}`.
 */
class m210702_150856_create_admin_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%admin}}', [
          'id' => $this->primaryKey(),
          'username' => $this->string()->unique(),
    
          'auth_key' => $this->string(32)->notNull(),
          'password_hash' => $this->string()->notNull(),
          'password_reset_token' => $this->string()->unique(),
          'verification_token' => $this->string()->defaultValue(null),

          'status' => $this->smallInteger()->notNull()->defaultValue(10),
          'created_at' => $this->integer()->notNull(),
          'updated_at' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%admin}}');
    }
}

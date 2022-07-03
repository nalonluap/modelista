<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contact_request}}`.
 */
class m210615_072353_create_contact_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contact_request}}', [
          'id' => $this->primaryKey(),
          'senderUserId' => $this->integer(),
          'recipientUserId' => $this->integer(),
          'status' => $this->integer()->defaultValue(0),
          'updated' => $this->datetime(),
          'created' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contact_request}}');
    }
}

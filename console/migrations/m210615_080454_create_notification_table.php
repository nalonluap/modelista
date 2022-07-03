<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 */
class m210615_080454_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'recipientUserId' => $this->integer(),
            'senderUserId' => $this->integer(),
            'type' => $this->integer()->defaultValue(0),
            'isRead' => $this->boolean ()->defaultValue(0),
            'updated' => $this->datetime(),
            'created' => $this->datetime(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%notification}}');
    }
}

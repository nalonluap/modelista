<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%model}}`.
 */
class m210614_122554_add_contacts_columns_to_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%model}}', 'phone', $this->string());
       $this->addColumn('{{%model}}', 'telegram', $this->string());
       $this->addColumn('{{%model}}', 'whatsapp', $this->string());
     }

     public function down()
     {
       $this->dropColumn('{{%model}}', 'phone');
       $this->dropColumn('{{%model}}', 'telegram');
       $this->dropColumn('{{%model}}', 'whatsapp');
     }
}

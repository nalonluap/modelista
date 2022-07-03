<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%model}}`.
 */
class m210615_141517_add_isHiddenContacts_column_to_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%model}}', 'isHiddenContacts', $this->boolean()->defaultValue(1));
     }

     public function down()
     {
       $this->dropColumn('{{%model}}', 'isHiddenContacts');
     }
}

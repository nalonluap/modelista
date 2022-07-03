<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%model}}`.
 */
class m210722_185056_add_tfp_column_to_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%model}}', 'tfp', $this->integer()->defaultValue(1));
     }

     public function down()
     {
       $this->dropColumn('{{%model}}', 'tfp');
     }
}

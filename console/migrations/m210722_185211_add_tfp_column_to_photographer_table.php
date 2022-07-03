<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photographer}}`.
 */
class m210722_185211_add_tfp_column_to_photographer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%photographer}}', 'tfp', $this->integer()->defaultValue(1));
     }

     public function down()
     {
       $this->dropColumn('{{%photographer}}', 'tfp');
     }
}

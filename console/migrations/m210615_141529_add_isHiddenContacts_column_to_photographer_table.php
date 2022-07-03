<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photographer}}`.
 */
class m210615_141529_add_isHiddenContacts_column_to_photographer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%photographer}}', 'isHiddenContacts', $this->boolean()->defaultValue(1));
     }

     public function down()
     {
       $this->dropColumn('{{%photographer}}', 'isHiddenContacts');
     }
}

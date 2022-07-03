<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%photograpger}}`.
 */
class m210624_115710_add_instagramCount_column_to_photograpger_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%photographer}}', 'instagramCount', $this->integer());
     }

     public function down()
     {
       $this->dropColumn('{{%photographer}}', 'instagramCount');
     }
}

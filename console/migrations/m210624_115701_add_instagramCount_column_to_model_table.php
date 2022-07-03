<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%model}}`.
 */
class m210624_115701_add_instagramCount_column_to_model_table extends Migration
{
    /**
     * {@inheritdoc}
     */
     public function up()
     {
       $this->addColumn('{{%model}}', 'instagramCount', $this->integer());
     }

     public function down()
     {
       $this->dropColumn('{{%model}}', 'instagramCount');
     }
}

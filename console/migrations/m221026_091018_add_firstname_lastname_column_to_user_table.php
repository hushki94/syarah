<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m221026_091018_add_firstname_lastname_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn( '{{%user}}' ,'first_name' , $this->string(255)->after('id'));
        $this->addColumn( '{{%user}}' ,'last_name' , $this->string(255)->after('first_name'));

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}' ,'first_name');
        $this->dropColumn('{{%user}}' ,'last_name');
    }
}

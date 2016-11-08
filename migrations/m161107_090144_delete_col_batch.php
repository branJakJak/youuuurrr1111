<?php

use yii\db\Migration;

class m161107_090144_delete_col_batch extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%batch}}', 'file_location');
    }

    public function down()
    {
        $this->addColumn('{{%batch}}', 'file_location', $this->string());
    }
}
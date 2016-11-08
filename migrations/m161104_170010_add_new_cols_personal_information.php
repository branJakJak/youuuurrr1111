<?php

use yii\db\Migration;

class m161104_170010_add_new_cols_personal_information extends Migration
{
    public function up()
    {
        $this->addColumn('{{%person_info}}', 'reference_id', $this->string());
        $this->addColumn('{{%person_info}}', 'batch_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('{{%person_info}}', 'reference_id');
        $this->dropColumn('{{%person_info}}', 'batch_id');
    }
}
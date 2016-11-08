<?php

use yii\db\Migration;

class m161107_093031_create_foreign_key extends Migration
{
    public function up()
    {
        $this->addForeignKey('batch_fk', '{{%person_info}}', 'batch_id', '{{%batch}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('batch_fk', '{{%person_info}}');
    }
}
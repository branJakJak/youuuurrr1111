<?php

use yii\db\Migration;

/**
 * Handles the creation for table `click_log`.
 */
class m161110_110243_create_click_log_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%click_log}}', [
            'id' => $this->primaryKey(),
            'person_id' => $this->integer(),
            'ip_address' => $this->string(),
            'user_agent' => $this->string(),
            'raw_access' => $this->text(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ], $tableOptions);  
        $this->addForeignKey('person_click_log_fk', '{{%click_log}}', 'person_id', '{{%person_info}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('person_click_log_fk', '{{%person_id}}');
        $this->dropTable('{{%click_log}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation for table `batch`.
 */
class m161104_170259_create_batch_table extends Migration
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
        $this->createTable('{{%batch}}', [
            'id' => $this->primaryKey(),
            //columns
            'batch_name'=> $this->string(),
            'file_location'=> $this->string(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ], $tableOptions);
    }
    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('batch');
    }
}

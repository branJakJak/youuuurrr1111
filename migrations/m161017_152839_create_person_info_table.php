<?php

use yii\db\Migration;

/**
 * Handles the creation for table `person_info`.
 */
class m161017_152839_create_person_info_table extends Migration
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
        $this->createTable('{{%person_info}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'firstname' => $this->string(),
            'lastname' => $this->string(),
            'mobilenumber' => $this->string(),
            'telephone' => $this->string(),
            'flatNumber' => $this->string(),
            'address' => $this->string(),
            'address1' => $this->string(),
            'address2' => $this->string(),
            'address3' => $this->string(),
            'address4' => $this->string(),
            'address5' => $this->string(),
            'postcode' => $this->string(),
            'emailAddress' => $this->string(),
            'dateOfBirth' => $this->string(),//   format is : mm/dd/yyyy , 
            'bankName' => $this->string(),// 
            'monthylFee' => $this->string(),// 
            'timeWithBank' => $this->string(),//
            //columns
            'created_at' => 'timestamp default CURRENT_TIMESTAMP',
            'updated_at' => $this->dateTime(),
        ], $tableOptions);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('person_info');
    }
}

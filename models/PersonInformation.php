<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $firstname
 * @property string $lastname
 * @property string $mobilenumber
 * @property string $telephone
 * @property string $flatNumber
 * @property string $address
 * @property string $address1
 * @property string $address2
 * @property string $address3
 * @property string $address4
 * @property string $address5
 * @property string $postcode
 * @property string $emailAddress
 * @property string $dateOfBirth
 * @property string $bankName
 * @property string $monthylFee
 * @property string $timeWithBank
 * @property string $reference_id
 * @property string $batch_id
 * @property string $created_at
 * @property string $updated_at
 */
class PersonInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'person_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['batch_id'], 'integer'],
            [['title', 'firstname', 'lastname', 'mobilenumber', 'telephone', 'flatNumber', 'address', 'address1', 'address2', 'address3', 'address4', 'address5', 'postcode', 'emailAddress', 'dateOfBirth', 'bankName', 'monthylFee', 'timeWithBank','reference_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'mobilenumber' => 'Mobilenumber',
            'telephone' => 'Telephone',
            'flatNumber' => 'Flat Number',
            'address' => 'Address',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'address4' => 'Address4',
            'address5' => 'Address5',
            'postcode' => 'Postcode',
            'emailAddress' => 'Email Address',
            'dateOfBirth' => 'Date Of Birth',
            'bankName' => 'Bank Name',
            'monthylFee' => 'Monthyl Fee',
            'timeWithBank' => 'Time With Bank',
            'batch_id' => 'Batch Reference #',
            'reference_id' => 'Auto generated ID #',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

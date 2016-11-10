<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "click_log".
 *
 * @property integer $id
 * @property integer $person_id
 * @property string $ip_address
 * @property string $user_agent
 * @property string $raw_access
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PersonInformation $person
 */
class ClickLog extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'click_log';
    }

    public static function getLogCount()
    {
        $query = new Query();
        $query->select('count(click_log.id) as num_recs')
            ->from(ClickLog::tableName())
            ->innerJoin('person_info', 'person_info.id = click_log.person_id');
        return $query;
    }
    public static function getExportQuery()
    {
        $query = new Query();
        $query->select('person_info.mobilenumber as mobilenumber')
            ->from(ClickLog::tableName())
            ->innerJoin('person_info', 'person_info.id = click_log.person_id');
        return $query;
    }
    public static function exportThisDayLog()
    {
        return ClickLog::getExportQuery()
            ->where(['date(click_log.created_at)' => date("Y-m-d")])
            ->all();
    }
    public static function exportThisWeekLog()
    {
        $startingDateWeek = strtotime("sunday last week");
        $endDateWeek = strtotime("sunday next week");
        return ClickLog::getExportQuery()
            ->where(['between','click_log.created_at',date("Y-m-d",$startingDateWeek),date("Y-m-d",$endDateWeek)])
            ->all();
    }
    public static function exportThisMonthLog()
    {
        $firstDayOfMonth = strtotime("first day of this month");
        $lastDayOfMonth = strtotime("last day of this month");
        return ClickLog::getExportQuery()
            ->where(['between','click_log.created_at',date("Y-m-d",$firstDayOfMonth),date("Y-m-d",$lastDayOfMonth)])
            ->all();
    }
    public static function getTodaysCount()
    {
        return ClickLog::getLogCount()
            ->where(['date(click_log.created_at)' => date("Y-m-d")])
            ->scalar();
    }

    public static function getThisWeeksLog()
    {
        $startingDateWeek = strtotime("sunday last week");
        $endDateWeek = strtotime("sunday next week");
        return ClickLog::getLogCount()
            ->where(['between','click_log.created_at',date("Y-m-d",$startingDateWeek),date("Y-m-d",$endDateWeek)])
            ->scalar();
    }

    public static function getThisMonthLog()
    {
        $firstDayOfMonth = strtotime("first day of this month");
        $lastDayOfMonth = strtotime("last day of this month");
        return ClickLog::getLogCount()
            ->where(['between','click_log.created_at',date("Y-m-d",$firstDayOfMonth),date("Y-m-d",$lastDayOfMonth)])
            ->scalar();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['person_id'], 'integer'],
            [['raw_access'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip_address', 'user_agent'], 'string', 'max' => 255],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => PersonInformation::className(), 'targetAttribute' => ['person_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'person_id' => 'Person ID',
            'ip_address' => 'Ip Address',
            'user_agent' => 'User Agent',
            'raw_access' => 'Raw Access',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(PersonInformation::className(), ['id' => 'person_id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value'=> new Expression("NOW()")
            ],           
        ];
    }

}

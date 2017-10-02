<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use app\models\Batch;
use yii\helpers\Html;

/**
 * UploadCsvFileForm
 */
class UploadCsvFileForm extends Model
{
    // Path of the csv file in the temp directory
    public $csvFile;
    public $original_file_name;
    public $batchObj;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['csvFile'], 'required'],
            [['original_file_name'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'csvFile' => 'CSV File',
        ];
    }

    public function import()
    {
        $returnMessage = [
            'status' => 'error',
            'message' => [
                'imported_data' => 0
            ]
        ];
        $outputFile = tempnam(sys_get_temp_dir(), "tmp_");
        $outPutFileRes = fopen($outputFile, "w+");
        $datasourceFileRes = fopen($this->csvFile, "r+");

        $this->batchObj = new Batch();
        $this->batchObj->batch_name = $this->original_file_name;
        if (!$this->batchObj->save()) {
            throw new Exception("Cant add new batch record . Reason : " . Html::errorSummary($this->batchObj));
        }

        while (!feof($datasourceFileRes)) {
            $curCsvLine = fgetcsv($datasourceFileRes);
            if (!empty($curCsvLine)) {
                $curData = ArrayHelper::merge([
                    date('Y-m-d H:i:s', time()),
                    substr(uniqid(), -4),
                    $this->batchObj->id,
                ], $curCsvLine);
                fputcsv($outPutFileRes, $curData);
            }
        }
        fclose($outPutFileRes);
        fclose($datasourceFileRes);
        $sqlCommand = <<<EOL
        LOAD DATA LOCAL INFILE "%s"
        INTO TABLE person_info
        FIELDS TERMINATED BY "%s"
        LINES TERMINATED BY "%s"
        IGNORE 0 LINES
        (@var1 ,reference_id,batch_id,title, firstname , lastname , telephone , mobilenumber , flatNumber , address , address1 , address2 , address3 , address4 , address5 , postcode , emailAddress  , dateOfBirth , bankName, monthylFee , timeWithBank )

EOL;
        $tempContainerArr = explode("=", Yii::$app->db->dsn);
        $databaseName = end($tempContainerArr);
        $databaseUsername = Yii::$app->db->username;
        $databasePassword = Yii::$app->db->password;
        $sqlCommand = sprintf($sqlCommand, $outputFile, ',', '\r\n');
        $sqlCommand .= 'set created_at = STR_TO_DATE(@var1,"%Y-%m-%d %h:%i:%s");';
        $mainCommand = "mysql --local-infile --user=$databaseUsername --password=$databasePassword --database=$databaseName -e '$sqlCommand'";
        $outputStr = `wc -l $outputFile`;
        $outputArr = explode(" ", $outputStr);
        $returnMessage = [
            'status' => 'success',
            'message' => [
                'imported_data' => $outputArr[0],
                'file_name' => $this->original_file_name
            ]
        ];
        $retMess = shell_exec($mainCommand);
        return $returnMessage;
    }

    public function getDownloadLink()
    {
        return Html::a('<span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download', ['/download/' . $this->batchObj->id], ['_target' => 'blank', 'class' => 'btn btn-block btn-primary']);
    }
}
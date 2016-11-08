<?php 

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Batch;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;

/**
* 
*/
class DownloadController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actionIndex($batchId)
    {
    	$batchObj = Batch::find()->where(['id'=>$batchId])->one();
    	if ($batchObj) {
    		/*download mobile with the links*/
    		$baseUrl = Url::home(true);
    		$sqlCommand = <<<EOL
    		select mobilenumber , concat("$baseUrl",reference_id) as link
    		from person_info where batch_id = :batch_id
EOL;
			$commandObj = Yii::$app->db->createCommand($sqlCommand);
			$commandObj->bindParam(":batch_id",$batchId);
			$results = $commandObj->queryAll();
			$outputCsvFile = tempnam(sys_get_temp_dir(), $batchObj->batch_name."_");
			$outputCsvFile .= '_'.date('Y-m-d H:i:s').'.csv';
			$outputCsvFileRes = fopen($outputCsvFile, 'w+');
			//put header
			fputcsv($outputCsvFileRes, array_keys($results[0]));
			foreach ($results as $currentLineResult) {
				$curVal =array_values($currentLineResult);
				fputcsv($outputCsvFileRes, $curVal);
			}
			fclose($outputCsvFileRes);
			$fileName = pathinfo($outputCsvFile,PATHINFO_FILENAME).'.csv';
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false);
			header("Content-Type: application/octet-stream");
			header('Content-Length: '.filesize($outputCsvFile));
			header("Content-Disposition: attachment; filename=\"$fileName\";" );
			header("Content-Transfer-Encoding: binary");
			echo file_get_contents($outputCsvFile);
		} else {
			throw new NotFoundHttpException("Batch record doesnt exists");
		}
    }
}
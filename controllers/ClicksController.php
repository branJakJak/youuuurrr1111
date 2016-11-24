<?php

namespace app\controllers;

use app\models\ClickLog;
use app\components\QueryRestulToCsv;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\filters\AccessControl;
use app\models\SearchClickForm;
use Yii;


class ClicksController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['export','index'],
                'rules' => [
                    [
                        'actions' => ['export','index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }    
    public function actionIndex()
    {
        $day = ClickLog::getTodaysCount();
    	$week = ClickLog::getThisWeeksLog();
    	$month = ClickLog::getThisMonthLog();
        $searchForm = new SearchClickForm();
        $clickLogDataProvider = new ArrayDataProvider();
        if ($searchForm->load(Yii::$app->request->post())) {
            $clickLogRawData= $searchForm->search();
            $clickLogDataProvider->allModels = $clickLogRawData;
        } else {
            $clickLogRawData = (new Query())
                ->select(['reference_id','mobilenumber','telephone'])
                ->from("person_info")
                ->innerJoin("click_log",'click_log.person_id = person_info.id')
                ->all();
            $clickLogDataProvider->allModels = $clickLogRawData;
        }
        $clickLogDataProvider->pagination->pageSize = 15;
        return $this->render('index',compact('day','week','month','searchForm','clickLogDataProvider'));
    }
    public function actionExport($report)
    {
		try {
            $report = ucfirst($report);
            $methodName = "exportThis{$report}Log";
            $convert = new QueryRestulToCsv();
            $convert->raw_result =ClickLog::$methodName();
            $convert->file_name = $report.'_'.substr(uniqid(), -4);
            $convert->convert();
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename='.basename($convert->path_to_file_output));
			header('Pragma: no-cache');            
            header('Content-Length: '.filesize($convert->path_to_file_output) );
            readfile($convert->path_to_file_output);
            Yii::$app->end();
		} catch (Exception $e) {
			return $this->redirect("/clicks/index");
		}
     }

}

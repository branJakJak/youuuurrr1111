<?php

namespace app\controllers;

use app\models\ClickLog;
use app\components\QueryRestulToCsv;


class ClicksController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $day = ClickLog::getTodaysCount();
    	$week = ClickLog::getThisWeeksLog();
    	$month = ClickLog::getThisMonthLog();
        return $this->render('index',compact('day','week','month'));
    }
    public function actionExport($report)
    {
		try {
            $report = ucfirst($report);
            $methodName = "exportThis{$report}Log";
            $convert = new QueryRestulToCsv();
            $convert->raw_result =ClickLog::$methodName();
            $convert->file_name = $report.'_';
            $convert->convert();
			header('Content-Type: application/csv');
			header('Content-Disposition: attachment; filename='.basename($convert->path_to_file_output));
			header('Pragma: no-cache');            
            header('Content-Length: '.filesize($convert->path_to_file_output) );
            readfile($convert->path_to_file_output);
		} catch (Exception $e) {
			return $this->redirect("/clicks/index");
		}
    }

}

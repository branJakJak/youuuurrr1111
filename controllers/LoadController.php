<?php

namespace app\controllers;

use app\models\PersonlInformation;

class LoadController extends \yii\web\Controller
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
    public function actionIndex($referenceId)
    {
		/* check if refence exists*/
		$personInfoObj = PersonlInformation::findOne(['reference_id'=>$referenceId]);
		if ($personInfoObj) {
			$attribs = $personInfoObj->attributes;
			var_dump($attribs);
			die();
			return $this->redirect(getenv('TARGET_URL') .'' );
		}else {
			throw new yii\web\NotFoundHttpException("Data not found");
		}
		Yii::$app->end();
    }

}

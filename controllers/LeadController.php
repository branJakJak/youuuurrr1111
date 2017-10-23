<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 10/21/2017
 * Time: 1:31 AM
 */

namespace app\controllers;


use app\models\ClickLog;
use app\models\PersonInformation;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LeadController extends Controller
{

    public function actionGetInformation($referenceId)
    {
        /* @var $personInformation PersonInformation */
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $personInformation = PersonInformation::find()->where(['reference_id' => $referenceId])->one();
        if (!$personInformation) {
            throw new NotFoundHttpException();
        }
        return [
            'data' => [
                'firstname'=>$personInformation->firstname,
                'lastname'=>$personInformation->lastname,
                'mobile'=>$personInformation->mobilenumber
            ]
        ];
    }

    public function actionIsClicked($referenceId)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $personInformation = PersonInformation::find()->where(['reference_id' => $referenceId])->one();
        if($personInformation){
            if (!ClickLog::find()->where(['person_id' => $personInformation->id])->exists()) {
                throw new NotFoundHttpException();
            }
        }

        return [
            'found' => true
        ];
    }
}
<?php

namespace app\controllers;

use app\models\ClickLog;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Batch;
use app\models\PersonInformation;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UnprocessableEntityHttpException;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'index'],
                'rules' => [
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $model = new \app\models\UploadCsvFileForm();
        $batchDataProvider = new ActiveDataProvider([
            'query' => Batch::find()->orderBy("created_at DESC")
        ]);
        if ($model->load(Yii::$app->request->post())) {
            $uploadedFile = UploadedFile::getInstance($model, 'csvFile');
            $model->csvFile = $uploadedFile->tempName;
            $model->original_file_name = $uploadedFile->name;
            if ($model->validate()) {
                $returnedMessage = $model->import();
                if ($returnedMessage['status'] === 'success') {
                    $fileName = $returnedMessage['message']['file_name'];
                    $importedData = $returnedMessage['message']['imported_data'];
                    $downloadLink = $model->getDownloadLink();
                    Yii::$app->session->setFlash('success', "<strong>Success!</strong>File imported {$fileName}:{$importedData} record(s). <br> <div style='margin-top: 60px;font-size: 50px'>$downloadLink</div>");
                }
                return $this->redirect('/site/index');
            }
        }
        return $this->render('index', compact('model', 'batchDataProvider'));
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRedirect($reference_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $target_redirect_url = getenv('TARGET_URL');
        $foundModel = PersonInformation::find()->where(['reference_id' => $reference_id])->one();
        /*check if exists*/
        if ($foundModel) {
            $tempContainer = $foundModel->attributes;
            unset($tempContainer['id']);
            unset($tempContainer['batch_id']);
            unset($tempContainer['reference_id']);
            unset($tempContainer['created_at']);
            unset($tempContainer['updated_at']);
            /*check if clicked before*/
            if (ClickLog::find()->where(['person_id' => $foundModel->id])->exists()) {
                throw new UnprocessableEntityHttpException("This lead has been clicked");
            } else {
                $logReq = new ClickLog();
                $logReq->ip_address = Yii::$app->request->getUserIP();
                $logReq->user_agent = Yii::$app->request->getUserAgent();
                $logReq->raw_access = json_encode($_SERVER);
                $logReq->person_id = $foundModel->id;
                $logReq->save(false);
                $target_redirect_url .= "?" . http_build_query($tempContainer);
                return [
                    'final_url' => $target_redirect_url,
                    'base_url' => getenv('TARGET_URL'),
                    'data' => $tempContainer    ,
                ];
            }
        } else {
            throw new NotFoundHttpException();
        }
    }
}

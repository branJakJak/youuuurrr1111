<?php
/* @var $this yii\web\View */

use kartik\form\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ListView;


$this->title =  Yii::$app->name;
?>




<div class="row">
    
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" >
        <?= ListView::widget([
            'dataProvider' => $batchDataProvider,
            'itemView' => '_batch',
        ]);?>
    </div>
    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8" >
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?= Yii::$app->session->getFlash('success') ?>
            </div>
        <?php endif ?>
        <div class="well" style="padding: 30px">
            <h1 class="text-center">Upload Here</h1>
            <div class="alert alert-info" style="padding: 30px">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>NOTE</strong> 
                <br>
                <br>
                <ul>
                    <li>
                        Please make sure to <strong>remove the header</strong> of the file and
                        <strong>Follow the order : </strong>
                        <br>
                        <br>
                        Firstname , Lastname , Telephone , Mobilenumber , FlatNumber , Address , Address1 , Address2 , Address3 , Address4 , Address5 , Postcode , EmailAddress , DateOfBirth,Bank Name , Monthly Fee,Time With Bank
                    </li>
                </ul>
                 
            </div>
            <?php 
            $form = ActiveForm::begin([
                'id' => 'login-form',
                'options' => ['class' => 'form-horizontal','enctype'=>'multipart/form-data']
                ]); 
            ?>

                <?=  
                $form
                ->field($model, 'csvFile')
                ->fileInput(['accept' => '.csv']);
                ?>
                <?= Html::submitButton("Submit", ['class' => 'btn btn-lg btn-primary']); ?>
            <?php ActiveForm::end(); ?>
        </div>        
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        
    </div>

</div>



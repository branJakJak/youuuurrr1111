<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Person Informations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-information-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Person Information', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'firstname',
            'lastname',
            'mobilenumber',
            // 'telephone',
            // 'flatNumber',
            // 'address',
            // 'address1',
            // 'address2',
            // 'address3',
            // 'address4',
            // 'address5',
            // 'postcode',
            // 'emailAddress:email',
            // 'dateOfBirth',
            // 'bankName',
            // 'monthylFee',
            // 'timeWithBank',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PersonInformation */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Person Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-information-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'firstname',
            'lastname',
            'mobilenumber',
            'telephone',
            'flatNumber',
            'address',
            'address1',
            'address2',
            'address3',
            'address4',
            'address5',
            'postcode',
            'emailAddress:email',
            'dateOfBirth',
            'bankName',
            'monthylFee',
            'timeWithBank',
            'timeWithBank',
            'created_at:datetime',
            'updated_at:datetime',
        ],
    ]) ?>

</div>

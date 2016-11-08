<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PersonInformation */

$this->title = 'Create Person Information';
$this->params['breadcrumbs'][] = ['label' => 'Person Informations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-information-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

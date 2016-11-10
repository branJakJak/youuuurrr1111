<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ClickLog */

$this->title = 'Create Click Log';
$this->params['breadcrumbs'][] = ['label' => 'Click Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="click-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

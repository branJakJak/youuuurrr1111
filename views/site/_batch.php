<?php 
use yii\helpers\Html;
?>
<div style="padding: 30px 10px;">
	<i>
		<?= $model->batch_name?> - <?= Yii::$app->formatter->asDateTime($model->created_at) ?> 
	</i>
	<?= 
		Html::a('<span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download', ['/download/'.$model->id], ['_target'=>'blank','class' => 'btn btn-block btn-primary'])
	?>
</div>
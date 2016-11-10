<?php 
use yii\helpers\Html;
?>
<div style="padding: 30px 10px;">
	<?= 
		Html::a('<span class="glyphicon glyphicon-download" aria-hidden="true"></span> Download', ['/download/'.$model->id], ['_target'=>'blank','class' => 'btn btn-link'])
	?>
	<b>
		<?= $model->batch_name?><br> 
	</b>
	<i style="padding-left: 10px">
		<?= Yii::$app->formatter->asDateTime($model->created_at) ?> 
	</i>
</div>
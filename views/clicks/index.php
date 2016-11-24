<?php
/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Html;
?>

<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
		<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>	Search
						</h3>
					</div>
					<div class="panel-body">
					    <?php $form = ActiveForm::begin(); ?>
				       		<div class="input-group">
				        		<?= $form->field($searchForm, 'search_term') ?>
								<span class="input-group-btn">
									<?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-search','style'=>'margin-top: 25px;']) ?>
								</span>
				          	</div>
					    <?php ActiveForm::end(); ?>
                        <hr>
					    <?= GridView::widget([
					    	'dataProvider' => $clickLogDataProvider,
					    	'columns' => [
					    		'mobilenumber',
					    		'reference_id',
					    		'telephone'
					    	]
					    ]);?>
					</div>
				</div>		
	</div>
	<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1 style="font-size: 50px;	text-align: center">
					Day
					<small class="" style="display: block;margin-top: 10px">
						<?= $day ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'day'], ['class' => 'btn btn-primary btn-block']); ?>
				</h1 style="font-size: 50px;	text-align: center">
			</div>
		</div>
		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1 style="font-size: 50px;	text-align: center">
					Week
					<small class="" style="display: block;margin-top: 10px">
						<?= $week ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'week'], ['class' => 'btn btn-primary btn-block']); ?>

				</h1 style="font-size: 50px;	text-align: center">
			</div>
		</div>
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1 style="font-size: 50px;	text-align: center">
					Month
					<small class="" style="display: block;margin-top: 10px">
						<?= $month ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'month'], ['class' => 'btn btn-primary btn-block']); ?>
				</h1 style="font-size: 50px;	text-align: center">
			</div>
		</div>
	</div>
</div>
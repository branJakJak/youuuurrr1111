<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1>
					Day
					<small class="pull-right" style="margin-top: 10px">
						<?= $day ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'day'], ['class' => 'btn btn-primary btn-block']); ?>
				</h1>
			</div>
		</div>	
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1>
					Week
					<small class="pull-right" style="margin-top: 10px">
						<?= $week ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'week'], ['class' => 'btn btn-primary btn-block']); ?>

				</h1>
			</div>
		</div>		
		<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
			<div class="well">
				<h1>
					Month
					<small class="pull-right" style="margin-top: 10px">
						<?= $month ?>
					</small>
					<hr>
					<?= Html::a("Export", ["/clicks/export",'report'=>'month'], ['class' => 'btn btn-primary btn-block']); ?>

				</h1>

			</div>
		</div>
	</div>
</div>

<?php
use kartik\popover\PopoverX;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\c\ActivosSysMetodosMedicion;
use kartik\widgets\DatePicker;

$url = \yii\helpers\Url::to(['site/probando']);
$model = new ActivosSysMetodosMedicion();
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false], 'id' => $model->formName()]);
	
	

PopoverX::begin([
    //'placement' => PopoverX::ALIGN_RIGHT_BOTTOM,
    'size' => PopoverX::SIZE_LARGE,
    'toggleButton' => ['label'=>'Login', 'class'=>'btn btn-default'],
    'header' => 'Metodo -- ',
    'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
             Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
]);
$tipo = 'promedio';

if($tipo == 'capas')
{
	$model->scenario = 'capas';
?>
<table class="table table-striped">
	<tr>
		<td><?= $form->field($model, 'enero')->textInput(['placeholder'=>'Enero']);?></td>
		<td><?= $form->field($model, 'febrero')->textInput(['placeholder'=>'Febrero']);?></td>
		<td><?= $form->field($model, 'marzo')->textInput(['placeholder'=>'Marzo']);?></td>
		<td><?= $form->field($model, 'abril')->textInput(['placeholder'=>'Abril']);?></td>
	</tr>
	<tr>
		<td><?= $form->field($model, 'mayo')->textInput(['placeholder'=>'Mayo']);?></td>
		<td><?= $form->field($model, 'junio')->textInput(['placeholder'=>'Junio']);?></td>
		<td><?= $form->field($model, 'julio')->textInput(['placeholder'=>'Julio']);?></td>
		<td><?= $form->field($model, 'agosto')->textInput(['placeholder'=>'Agosto']);?></td>
	</tr>

	<tr>
		<td><?= $form->field($model, 'septiembre')->textInput(['placeholder'=>'Septiembre']);?></td>
		<td><?= $form->field($model, 'octubre')->textInput(['placeholder'=>'Octubre']);?></td>
		<td><?= $form->field($model, 'noviembre')->textInput(['placeholder'=>'Noviembre']);?></td>
		<td><?= $form->field($model, 'diciembre')->textInput(['placeholder'=>'Diciembre']);?></td>
	</tr>
</table>
<?php
}elseif($tipo == 'promedio')
{
	$model->scenario = 'promedio';
?>
<table class="table table-striped">
	<tr>
		<td><?= 
			$form->field($model, 'desde')->widget(DatePicker::classname(), [
			    'options' => ['placeholder' => 'Desde'],
			    'pluginOptions' => [
			    	'format' => 'M',
			        'autoclose'=>true
			    ]
			]);
		?></td>
		<td><?=

			$form->field($model, 'hasta')->widget(DatePicker::classname(), [
			    'options' => ['placeholder' => 'Hasta'],
			    'pluginOptions' => [
			        'format' => 'M',
			        'autoclose'=>true
			    ]
			]);
		?></td>
	</tr>
</table>
<?php	
}
PopoverX::end();
ActiveForm::end();
?>

<?php

$script = <<< JS
	$('form#{$model->formName()}').on('beforeSubmit', function(e)
	{
		var \$form = $(this);
		$.post(
			\$form.attr("action"), \$form.serialize()
		).done(function(result)
		{
			\$form.trigger("reset");
		}).fail(function()
		{
			console.log("error");
		})
		return false;
	});
JS;
$this->registerJs($script);
?>
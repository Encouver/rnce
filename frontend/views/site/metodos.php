<?php
use kartik\popover\PopoverX;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\c\ActivosSysMetodosMedicion;
use kartik\widgets\DatePicker;

$url = \yii\helpers\Url::to(['site/probando']);

$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false], 'id' => 'form_metodos']);
	$model = new ActivosSysMetodosMedicion();
	

PopoverX::begin([
    //'placement' => PopoverX::ALIGN_RIGHT_BOTTOM,
    'size' => PopoverX::SIZE_LARGE,
    'toggleButton' => ['label'=>'Login', 'class'=>'btn btn-default'],
    'header' => 'Metodo -- ',
    'footer'=>Html::Button('Submit', ['class'=>'btn btn-sm btn-primary']) .
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
    $('#enviar15').click(function(e){
            if($('form#modal_pnatural').find('.has-error').length!=0){
                return false;
            }else
            {
                //$('form#modal_pnatural').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-naturales/crearpersonanatural',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
                    }
                });
            }
    });
JS;
$this->registerJs($script);
?>
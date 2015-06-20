<?php 
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use common\models\a\ActivosSysMetodosMedicion;
use kartik\widgets\DatePicker;

 $sysmetodos = new ActivosSysMetodosMedicion();
 $sysmetodos->scenario = 'promedio';
 $url = \yii\helpers\Url::to(['site/probando']);  //colocar url

$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false], 'id' => $sysmetodos->formName(), 'action' => $url]);
?>

<table class="table table-striped">
	<tr>
		<td><?= 
			$form->field($sysmetodos, 'desde')->widget(DatePicker::classname(), [
			    'options' => ['placeholder' => 'Desde'],
			    'pluginOptions' => [
			    	'format' => 'M',
			        'autoclose'=>true
			    ]
			]);
		?></td>
		<td><?=

			$form->field($sysmetodos, 'hasta')->widget(DatePicker::classname(), [
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
echo Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
    Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default']);
    ActiveForm::end();

?>
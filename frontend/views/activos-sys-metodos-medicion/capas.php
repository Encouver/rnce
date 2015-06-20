<?php 
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use common\models\a\ActivosSysMetodosMedicion;

 $sysmetodos = new ActivosSysMetodosMedicion();
 $sysmetodos->scenario = 'capas';
 $url = \yii\helpers\Url::to(['site/probando']);  //colocar url

$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false], 'id' => $sysmetodos->formName(), 'action' => $url]);
?>
<table class="table table-striped">
    <tr>
        <td><?= $form->field($sysmetodos, 'enero')->textInput(['placeholder'=>'Enero']);?></td>
        <td><?= $form->field($sysmetodos, 'febrero')->textInput(['placeholder'=>'Febrero']);?></td>
        <td><?= $form->field($sysmetodos, 'marzo')->textInput(['placeholder'=>'Marzo']);?></td>
        <td><?= $form->field($sysmetodos, 'abril')->textInput(['placeholder'=>'Abril']);?></td>
    </tr>
    <tr>
        <td><?= $form->field($sysmetodos, 'mayo')->textInput(['placeholder'=>'Mayo']);?></td>
        <td><?= $form->field($sysmetodos, 'junio')->textInput(['placeholder'=>'Junio']);?></td>
        <td><?= $form->field($sysmetodos, 'julio')->textInput(['placeholder'=>'Julio']);?></td>
        <td><?= $form->field($sysmetodos, 'agosto')->textInput(['placeholder'=>'Agosto']);?></td>
    </tr>

    <tr>
        <td><?= $form->field($sysmetodos, 'septiembre')->textInput(['placeholder'=>'Septiembre']);?></td>
        <td><?= $form->field($sysmetodos, 'octubre')->textInput(['placeholder'=>'Octubre']);?></td>
        <td><?= $form->field($sysmetodos, 'noviembre')->textInput(['placeholder'=>'Noviembre']);?></td>
        <td><?= $form->field($sysmetodos, 'diciembre')->textInput(['placeholder'=>'Diciembre']);?></td>
    </tr>
</table>
<?php
echo Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
    Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default']);
    ActiveForm::end();

?>
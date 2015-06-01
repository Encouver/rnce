<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\builder\Form;

$url = \yii\helpers\Url::to(['site/probando']);
$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false], 'id' => $model->formName(), 'action' => $url]);
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
echo Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
    Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default']);
    ActiveForm::end();
?>
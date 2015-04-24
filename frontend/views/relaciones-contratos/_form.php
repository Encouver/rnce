<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model common\models\p\RelacionesContratos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relaciones-contratos-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model2, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model2, 'denominacion')->textInput(['maxlength' => 50]) ?> 

    <?= $form->field($model, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_contrato')->dropDownList([ 'OBRAS' => 'OBRAS', 'SERVICIOS' => 'SERVICIOS', 'BIENES' => 'BIENES', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nombre_proyecto')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'fecha_inicio')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>
     <?= $form->field($model, 'fecha_fin')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>

    <?= $form->field($model, 'monto_contrato')->textInput() ?>

    <?= $form->field($model, 'anticipo_recibido')->textInput() ?>

    <?= $form->field($model, 'porcentaje_ejecucion')->textInput() ?>

    <?= $form->field($model, 'evaluacion_ente')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

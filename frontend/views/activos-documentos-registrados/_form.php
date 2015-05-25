<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDocumentosRegistrados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-documentos-registrados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
    echo '<h2> Carga de Documento Registrado: </h2>';
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$model->getFormAttribs()
    ]);
    ?>

<!--
    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'sys_tipo_registro_id')->textInput() */?>

    <?/*= $form->field($model, 'num_registro_notaria')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'tomo')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'folio')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'fecha_registro')->textInput() */?>

    <?/*= $form->field($model, 'fecha_asamblea')->textInput() */?>

    <?/*= $form->field($model, 'sys_circunscripcion_id')->textInput() */?>

    <?/*= $form->field($model, 'valor_adquisicion')->textInput() */?>

    <?/*= $form->field($model, 'tipo_documento_id')->textInput() */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

   --> <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

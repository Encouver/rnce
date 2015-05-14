<?php

use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosBienes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-bienes-form">


    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->getFormAttribs()
        ]);

        if($bienTipo != null)
        echo Form::widget([       // 3 column layout
            'model'=>$bienTipo,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$bienTipo->getFormAttribs()
        ]);

    ?>
<!--
    <?/*= $form->field($model, 'sys_tipo_bien_id')->textInput() */?>

    <?/*= $form->field($model, 'principio_contable')->textInput() */?>

    <?/*= $form->field($model, 'depreciable')->checkbox() */?>

    <?/*= $form->field($model, 'deterioro')->checkbox() */?>

    <?/*= $form->field($model, 'detalle')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'origen')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'fecha_origen')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'propio')->checkbox() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>
    -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

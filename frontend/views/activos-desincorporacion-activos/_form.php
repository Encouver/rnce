<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;



/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDesincorporacionActivos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-desincorporacion-activos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        echo '<h2> Desincorporación de Bienes: </h2>';
        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->getFormAttribs()
        ]);
    ?>
<!--
    <?/*= $form->field($model, 'sys_motivo_id')->textInput() */?>

    <?/*= $form->field($model, 'fecha')->textInput() */?>

    <?/*= $form->field($model, 'precio_venta')->textInput() */?>

    <?/*= $form->field($model, 'valor_neto_libro')->textInput() */?>

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

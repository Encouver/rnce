<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosFacturas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-facturas-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'type'=>ActiveForm::TYPE_VERTICAL, 'options' => ['data-pjax' => Yii::$app->request->isPjax]]); ?>

    <?php
        //echo '<h2> Carga de Factura: </h2>';
        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->getFormAttribs()
        ]);
    ?>

    <!--

    <?/*= $form->field($model, 'num_factura')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'proveedor_id')->textInput() */?>

    <?/*= $form->field($model, 'fecha_emision')->textInput() */?>

    <?/*= $form->field($model, 'imprenta_id')->textInput() */?>

    <?/*= $form->field($model, 'fecha_emision_talonario')->textInput() */?>

    <?/*= $form->field($model, 'comprador_id')->textInput() */?>

    <?/*= $form->field($model, 'base_imponible_gravable')->textInput() */?>

    <?/*= $form->field($model, 'exento')->textInput() */?>

    <?/*= $form->field($model, 'iva')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

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

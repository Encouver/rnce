<?php

use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi2GastosPersonal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-ii2-gastos-personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    echo '<h2> Cuenta II-2 - Gastos personal: </h2>';
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$model->formAttribs
    ]);

    ?>
<!--
    <?/*= $form->field($model, 'concepto_id')->textInput() */?>

    <?/*= $form->field($model, 'administracion')->textInput() */?>

    <?/*= $form->field($model, 'admin_metodo_id')->textInput() */?>

    <?/*= $form->field($model, 'administracion_ajustadas')->textInput() */?>

    <?/*= $form->field($model, 'ventas')->textInput() */?>

    <?/*= $form->field($model, 'ventas_metodo_id')->textInput() */?>

    <?/*= $form->field($model, 'ventas_ajustadas')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

  -->  <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

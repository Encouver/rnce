<?php

use kartik\builder\Form;
use kartik\builder\TabularForm;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI2DeclaracionIva */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i2-declaracion-iva-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

        echo '<h2> Cuenta I-2.2 - Declaración de Impuesto al valor Agregado (IVA): </h2>';
/*        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->formAttribs
        ]);*/

        echo TabularForm::widget([
            // set entire form to static only (read only)
            //'staticOnly'=>true,
            'actionColumn'=>false,
            'dataProvider'=>$dataProvider,
            'form'=>$form,
            'attributes'=>$model->formAttribs
        ]);
    ?>

<!--
    <?/*= $form->field($model, 'periodo_id')->textInput() */?>

    <?/*= $form->field($model, 'certificado_electronico')->textInput() */?>

    <?/*= $form->field($model, 'ventas_grabadas')->textInput() */?>

    <?/*= $form->field($model, 'ventas_no_grabadas')->textInput() */?>

    <?/*= $form->field($model, 'ingresos_totales')->textInput() */?>

    <?/*= $form->field($model, 'debito_fiscal')->textInput() */?>

    <?/*= $form->field($model, 'compras_gravadas')->textInput() */?>

    <?/*= $form->field($model, 'compras_no_gravadas')->textInput() */?>

    <?/*= $form->field($model, 'egresos_totales_compra')->textInput() */?>

    <?/*= $form->field($model, 'credito_fiscal')->textInput() */?>

    <?/*= $form->field($model, 'imp_pagar_compensar')->textInput() */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

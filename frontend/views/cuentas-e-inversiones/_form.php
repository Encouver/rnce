<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasEInversiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-einversiones-form">

    <?php $form = ActiveForm::begin(['options'=> ['enctype'=>'multipart/form-data']]); ?>

    <?php
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$model->getFormAttribs()
    ]);

    echo Form::widget([       // 3 column layout
        'model'=>$modelInfoAdicional,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$modelInfoAdicional->getFormAttribs()
    ]);

    ?>
    <div id="adquisicion-container" hidden="true">
        <h3>Adquisición</h3>
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoAdquisicion,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoAdquisicion->getFormAttribs()
        ]);
    ?>
    </div>
    <div id="adicion-container" hidden="true">
        <h3>Adición</h3>
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoAdicion,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoAdicion->getFormAttribs()
        ]);
    ?>
    </div>
    <div id="retiro-container" hidden="true">
        <h3>Retiro</h3>
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoRetiro,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoRetiro->getFormAttribs()
        ]);
    ?>
    </div>

    <?php


    $script = <<< JS


    function movimiento(tipoMovimiento, container){
            if($(tipoMovimiento).is(':checked') ){
            //if($('#cuentaseinversiones-adquisicion').val()==1){
               $(container).show();
            }//alert($('#activosbienes-nacional').val());
            if(!$(tipoMovimiento).is(':checked')){
             //if($('#cuentaseinversiones-adquisicion').val()==0){
                 $(container).hide();
             }

    }
     $('#cuentaseinversiones-adquisicion').change(function(e){

               movimiento('#cuentaseinversiones-adquisicion','#adquisicion-container');
        });
     $('#cuentaseinversiones-adicion').change(function(e){

               movimiento('#cuentaseinversiones-adicion','#adicion-container');
        });
     $('#cuentaseinversiones-retiro').change(function(e){

               movimiento('#cuentaseinversiones-retiro','#retiro-container');
        });



JS;
    $this->registerJs($script);
    ?>
<!--
    <?/*= $form->field($model, 'empresa_relacionada_id')->textInput() */?>

    <?/*= $form->field($model, 'corriente')->checkbox() */?>

    <?/*= $form->field($model, 'disponibilidad')->dropDownList([ 'DISPONIBLES PARA LA VENTA' => 'DISPONIBLES PARA LA VENTA', 'NO DISPONIBLES PARA LA VENTA' => 'NO DISPONIBLES PARA LA VENTA', 'SUBSIDIARIAS' => 'SUBSIDIARIAS', ' NEGOCIOS CONJUNTOS Y ASOCIADAS' => ' NEGOCIOS CONJUNTOS Y ASOCIADAS', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'tipo_instrumento')->dropDownList([ 'ACCIONES' => 'ACCIONES', 'BONOS' => 'BONOS', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'nombre_instrumento')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'motivo_retiro')->dropDownList([ 'CESION' => 'CESION', 'DETERIORO' => 'DETERIORO', 'VENTA' => 'VENTA', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'numero_acc_bon')->textInput() */?>

    <?/*= $form->field($model, 'e_inversion_info_adicional_id')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

    <?/*= $form->field($model, 'fecha_motivo')->textInput() */?>

    -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>

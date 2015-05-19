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

        if($model->origen_id == 2 && !$model->nacional )
            echo Form::widget([       // 3 column layout
                'model'=>$modelDatosImportacion,
                'form'=>$form,
                'columns'=>4,
                'columnSize'=>'xs',
                'attributes'=>$modelDatosImportacion->getFormAttribs($model)
            ]);


        if($modelBienTipo != null)
            echo Form::widget([       // 3 column layout
                'model'=>$modelBienTipo,
                'form'=>$form,
                'columns'=>4,
                'columnSize'=>'xs',
                'attributes'=>$modelBienTipo->getFormAttribs($model)
            ]);

        if($model->factura)
            echo Form::widget([       // 3 column layout
                'model'=>$modelFactura,
                'form'=>$form,
                'columns'=>4,
                'columnSize'=>'xs',
                'attributes'=>$modelFactura->getFormAttribs($model)
            ]);

        if($model->documento)
            echo Form::widget([       // 3 column layout
                'model'=>$modelDocumento,
                'form'=>$form,
                'columns'=>4,
                'columnSize'=>'xs',
                'attributes'=>$modelDocumento->getFormAttribs($model)
            ]);
        if($model->sysTipoBien->deterioro)
            echo Form::widget([       // 3 column layout
                'model'=>$modelDeterioro,
                'form'=>$form,
                'columns'=>4,
                'columnSize'=>'xs',
                'attributes'=>$modelDeterioro->getFormAttribs()
            ]);


    $script = <<< JS
        $('#origen').change(function(e){
                if($('#origen').val()== 1 || $('#origen').val()==4){
                    $('#fecha_origen').show();
                    $('#nacional').hide();
                }else if ($('#origen').val()==2) {
                    $('#fecha_origen').hide();
                    $('#nacional').show();
                }else
                {
                    $('#fecha_origen').hide();
                    $('#nacional').hide();
                }
        });
JS;
    $this->registerJs($script);

/*        echo '<label class="cbx-label" for="s_2">Left</label>';
        echo CheckboxX::widget([
            'name'=>'s_2',
            'value'=>1,
            'options'=>['id'=>'s_2']
        ]);*/
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
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['id'=>'crear','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

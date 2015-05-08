<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'rif')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'ci')->textInput() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'telefono_local')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'telefono_celular')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'pagina_web')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'instagram')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sys_pais_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'numero_identificacion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nacionalidad')->dropDownList([ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estado_civil')->dropDownList([ 'SOLTERO (A)' => 'SOLTERO (A)', 'CASADO (A)' => 'CASADO (A)', 'CONCUBINO (A)' => 'CONCUBINO (A)', 'DIVORCIADO (A)' => 'DIVORCIADO (A)', 'VIUDO (A)' => 'VIUDO (A)', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

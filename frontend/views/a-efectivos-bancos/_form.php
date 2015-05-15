<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosBancos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aefectivos-bancos-form">
<?php
/*
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_contratista_id')->textInput() ?>

    <?= $form->field($model, 'saldo_segun_b')->textInput() ?>

    <?= $form->field($model, 'nd_no_cont')->textInput() ?>

    <?= $form->field($model, 'depo_transito')->textInput() ?>

    <?= $form->field($model, 'nc_no_cont')->textInput() ?>

    <?= $form->field($model, 'cheques_transito')->textInput() ?>

    <?= $form->field($model, 'saldo_al_cierre')->textInput() ?>

    <?= $form->field($model, 'intereses_act_eco')->textInput() ?>

    <?= $form->field($model, 'tipo_moneda_id')->textInput() ?>

    <?= $form->field($model, 'monto_moneda_extra')->textInput() ?>

    <?= $form->field($model, 'tipo_cambio_cierre')->textInput() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'total_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); 

    */

    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> ($model->nacional) ? $model->getFormAttribs('nacional') : $model->getFormAttribs('extranjera')
    ]);
    echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();


        //echo 'nacional '. $nacional;

    ?>



</div>

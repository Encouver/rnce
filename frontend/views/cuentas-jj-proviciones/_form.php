<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasJjProviciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-jj-proviciones-form">
<?php

    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
    echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
/*
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'saldo_p_anterior')->textInput() ?>

    <?= $form->field($model, 'importe_provisionado_periodo')->textInput() ?>

    <?= $form->field($model, 'aplicacion_amortizacion')->textInput() ?>

    <?= $form->field($model, 'saldo_al_cierre')->textInput() ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    */
?>
</div>

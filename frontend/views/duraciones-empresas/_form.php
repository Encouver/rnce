<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\p\DuracionesEmpresas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duraciones-empresas-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'duracion_anos')->textInput()?>
    <?= $form->field($model, 'documento_registrado_id')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

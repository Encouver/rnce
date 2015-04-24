<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\PrincipiosContables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="principios-contables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'principio_contable')->dropDownList([ 'PYME' => 'PYME', 'OSP' => 'OSP', 'FP' => 'FP', 'PN' => 'PN', 'COOPERATIVA' => 'COOPERATIVA', 'ESPECIAL' => 'ESPECIAL', 'GRAN ENTIDAD' => 'GRAN ENTIDAD', 'EMPRESA DE SEGURO' => 'EMPRESA DE SEGURO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'codigo_sudeaseg')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotasRevelatorias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notas-revelatorias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nota')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'cuenta')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

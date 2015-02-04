<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inpc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'mes')->textInput() ?>

    <?= $form->field($model, 'indice')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

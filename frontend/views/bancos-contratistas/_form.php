<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysBancos;

/* @var $this yii\web\View */
/* @var $model common\models\p\BancosContratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

    <?php $form = ActiveForm::begin(); ?>
    
     <?= $form->field($model, 'banco_id')->dropDownList(
        ArrayHelper::map(SysBancos::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Banco'] 
             ) ?>


    <?= $form->field($model, 'num_cuenta')->textInput() ?>

    <?= $form->field($model, 'tipo_moneda')->dropDownList([ 'BOLIVARES' => 'BOLIVARES', 'DOLARES' => 'DOLARES', 'EUROS' => 'EUROS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_cuenta')->dropDownList([ 'CUENTA CORRIENTE' => 'CUENTA CORRIENTE', 'CUENTA CORRIENTE CON INTERESES / REMUNERADA' => 'CUENTA CORRIENTE CON INTERESES / REMUNERADA', 'CUENTA DE AHORROS' => 'CUENTA DE AHORROS', 'CUENTA EN MONEDA EXTRANGERA' => 'CUENTA EN MONEDA EXTRANGERA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estatus_cuenta')->dropDownList([ 'ACTIVA' => 'ACTIVA', 'INACTIVA' => 'INACTIVA', ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

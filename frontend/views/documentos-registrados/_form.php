<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\a\SysTiposRegistros;
use yii\jui\DatePicker

/* @var $this yii\web\View */
/* @var $model common\models\a\DocumentosRegistrados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-registrados-form">

    <?php $form = ActiveForm::begin(); ?>

    
     <?= $form->field($model, 'sys_tipo_registro_id')->dropDownList(
        ArrayHelper::map(SysTiposRegistros::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione tipo'] 
             ) ?>

    <?= $form->field($model, 'circunscripcion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'num_registro_notaria')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tomo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'folio')->textInput(['maxlength' => 100]) ?>
    
      <?= $form->field($model, 'fecha_registro')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>


    <?= $form->field($model, 'valor_adquisicion')->textInput() ?>
    
    <?= $form->field($model, 'fecha_asamblea')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;
/* @var $this yii\web\View */
/* @var $model common\models\p\Domicilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domicilios-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model2, 'sys_estado_id')->dropDownList(
        ArrayHelper::map(SysEstados::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Estado'] 
             ) ?>
    
    <?= $form->field($model2, 'sys_municipio_id')->dropDownList(
        ArrayHelper::map(SysMunicipios::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Municipio'] 
             ) ?>
    
     <?= $form->field($model2, 'sys_parroquia_id')->dropDownList(
        ArrayHelper::map(SysParroquias::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Parroquia'] 
             ) ?>

     <?= $form->field($model2, 'zona')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'calle')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'casa')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'nivel')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model2, 'numero')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model2, 'referencia')->textarea(['rows' => 6]) ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

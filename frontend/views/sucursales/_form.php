<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;

/* @var $this yii\web\View */
/* @var $model common\models\p\Sucursales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sucursales-form">

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
    
    <h1><?= Html::encode("Persona de contacto") ?></h1>
    
     <?= $form->field($model3, 'rif')->textInput(['maxlength' => 20]) ?>
    
     <?= $form->field($model3, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'telefono_local')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model3, 'telefono_celular')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model3, 'fax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model3, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model3, 'pagina_web')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'facebook')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'twitter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model3, 'instagram')->textInput(['maxlength' => 255]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

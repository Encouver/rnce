<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;
/* @var $this yii\web\View */
/* @var $model common\models\p\ContratistasContactos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-contactos-form">

    <?php $form = ActiveForm::begin(); ?>
        
    <?= $form->field($model2, 'rif')->textInput(['maxlength' => 20]) ?>
    
     <?= $form->field($model2, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'telefono_local')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model2, 'telefono_celular')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model2, 'fax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model2, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model2, 'pagina_web')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'facebook')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'twitter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model2, 'instagram')->textInput(['maxlength' => 255]) ?>


   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysCaev;
/* @var $this yii\web\View */
/* @var $model common\models\p\ActividadesEconomicas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-economicas-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'ppal_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione Actividad economica principal'] 
             ) ?>

    
    <?= $form->field($model, 'ppal_experiencia')->textInput() ?>

     <?= $form->field($model, 'comp1_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione actividad economica complementaria 1'] 
             ) ?>
    
     <?= $form->field($model, 'comp1_experiencia')->textInput() ?>

     <?= $form->field($model, 'comp2_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione actividad economica complementaria 2'] 
             ) ?>
    

    <?= $form->field($model, 'comp2_experiencia')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

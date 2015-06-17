<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\widgets\Pjax;
$urlJuridica = Url::to(['personas-juridicas/create']);

/* @var $this yii\web\View */
/* @var $model common\models\p\PolizasContratadas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polizas-contratadas-form">
 <?php Modal::begin([
    'options'=>['id'=>'persona_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Juridica', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-documento2">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form3 = ActiveForm::begin(['id'=>$modelJuridica->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlJuridica, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelJuridica,
                'form'=>$form3,
                'columns'=>3,
                'attributes'=>$modelJuridica->getformAttribs()
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

 <?php Modal::end(); ?>     

 <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs()
      ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

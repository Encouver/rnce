<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
$url = \yii\helpers\Url::to(['acciones/accionsuscritaacta']);
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-actas-form">

    <?php $form = ActiveForm::begin(['id'=>'certificados_suscrita',
        'method'=>'post',
        'action'=>['certificados/certificadosuscritaacta'],
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>false]); ?>
    
<h3>Certificados Suscritas y Pagadas</h3>
<hr />
 <?php echo Form::widget([
    'model'=>$certificado_acta,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$certificado_acta->getFormAttribs('principal')
      ]); ?>
    <div id="output17"></div>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
 
</div>

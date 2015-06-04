<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosEmpresas */
/* @var $form yii\widgets\ActiveForm */
$data = [
 'PROVEEDOR'=> ['PRODUCTOR'=>'PRODUCTOR', 'FABRICANTE'=>'FABRICANTE','FABRICANTE IMPORTADOR'=>'FABRICANTE IMPORTADOR','DISTRIBUIDOR'=>'DISTRIBUIDOR','DISTRIBUIDOR IMPORTADOR'=>'DISTRIBUIDOR IMPORTADOR'],
 'SERVICIOS'=>['SERVICIOS BASICOS'=>'SERVICIOS BASICOS' ,'SERVICIOS PROFESIONALES'=>'SERVICIOS PROFESIONALES'],
 'OBRAS'=>['OBRAS' => "OBRAS",]
 ];
?>

<div class="objetos-empresas-form">

    <?php $form = ActiveForm::begin(); ?>

 <?= '<label class="control-label">Objeto de la empresa</label>'; ?>
<?= Select2::widget([
    'name' => 'objeto', 
    'data' => $data,
    'options' => [
        'placeholder' => 'Select provinces ...', 
        'multiple' => true
    ],

]);?>
    <br>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

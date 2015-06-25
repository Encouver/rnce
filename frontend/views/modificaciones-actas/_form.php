<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\p\ModificacionesActas */
/* @var $form yii\widgets\ActiveForm */
$data = ['pago_capital'=>'PAGO DE CAPITAL', 'aporte_capitalizar'=>'APORTES POR CAPITALIZAR','aumento_capital'=>'AUMENTO DE CAPITAL',
        'coreccion_monetaria'=>'CORRECCION MONETARIA', 'disminucion_capital'=>'DISMINUCION DE CAPITAL','limitacion_capital'=>'LIMITACION CAPITAL (SIN AFECTAR EL CAPITAL)',
        'limitacion_capital_afectado'=>'LIMITACION CAPITAL (AFECTA EL CAPITAL)','reintegro_perdida'=>'REINTEGRO DE PERDIDAS',
        'venta_accion'=>'VENTA DE ACCION O CUOTA DE PARTICIPACION', 'fusion_empresarial'=>'FUSION_EMPRESARIAL','razon_social'=>'CAMBIO DE NOMBRE O RAZON SOCIAL',
        'modificacion_balance'=>'DISCUSION Y APROBACION O MODIFICACION DE BALANCE','denominacion_comercial'=>'DENOMINACION COMERCIAL',
        'domicilio_fiscal'=>' CAMBIO DE DOMICILIO','objeto_social'=>'CAMBIO DE OBJETO SOCIAL','cierre_ejercicio'=>'CAMBIO DEL CIERRE DE EJERCICIO ECONOMICO',
        'representante_legal'=>'NOMBRAMIENTO DEL REPRESENTANTE LEGAL', 'junta_directiva'=>'ACTUALIZACION JUNTA DIRECTIVA','comisario'=>'DESIGNACION DEL COMISARIO','duracion_empresa'=>'PRORROGA DURACION EMPRESA',
    ];
if($acciones){
     $data['decreto_div_excedente']='DECRETO DE DIVIENDOS EN EFECTIVO';
}else{
    $data['decreto_div_excedente']='DECRETO DE EXCEDENTES';
    $data['fondo_emergencia']='UTILIZACION DEL FONDO DE EMERGENCIA';
}

?>


<div class="modificaciones-actas-form">

    <?php $form = ActiveForm::begin(); ?>
 <?= '<label class="control-label">Modificaciones</label>'; ?>
<?= Select2::widget([
    'name' => 'objeto', 
    'data' => $data,
    'options' => [
        'placeholder' => 'Select provinces ...', 
        'multiple' => true,
        'style' => 'width:33%;',
    ],
]);?>
    <br>  
 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

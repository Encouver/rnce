<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModificacionesActasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modificaciones Actas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificaciones-actas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

           // 'id',
            //'contratista_id',
            //'documento_registrado_id',
            'pago_capital:boolean',
            'aporte_capitalizar:boolean',
            'aumento_capital:boolean',
            'coreccion_monetaria:boolean',
            'disminucion_capital:boolean',
            'limitacion_capital:boolean',
            'limitacion_capital_afectado:boolean',
            'fondo_emergencia:boolean',
            'reintegro_perdida:boolean',
            'venta_accion:boolean',
            'fusion_empresarial:boolean',
            'decreto_div_excedente:boolean',
            'modificacion_balance:boolean',
            'razon_social:boolean',
            'denominacion_comercial:boolean',
            'domicilio_fiscal:boolean',
            'domicilio_principal:boolean',
            'objeto_social:boolean',
            'representante_legal:boolean',
            'junta_directiva:boolean',
            'duracion_empresa:boolean',
            'cierre_ejercicio:boolean',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn','template'=>'{delete}'],
        ],
    ]); ?>
      <?php if(!$searchModel->existeregistro()){?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Modificaciones Actas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php } ?>

</div>

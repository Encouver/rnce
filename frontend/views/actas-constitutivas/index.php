<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ActasConstitutivasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Actas Constitutivas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actas-constitutivas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Actas Constitutivas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'documento_registrado_id',
            'denominacion_comercial_id',
            'duracion_empresa_id',
            // 'objeto_social_id',
            // 'razon_social_id',
            // 'domicilio_id',
            // 'accionista_otro',
            // 'comisario_auditor_id',
            // 'cierre_ejercicio_id',
            // 'fecha_modificacion',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'capital_principal:boolean',
            // 'pago_capital:boolean',
            // 'aporte_capitalizar:boolean',
            // 'aumento_capital:boolean',
            // 'coreccion_monetaria:boolean',
            // 'disminucion_capital:boolean',
            // 'limitacion_capital:boolean',
            // 'limitacion_capital_afectado:boolean',
            // 'fondo_emergencia:boolean',
            // 'reintegro_perdida:boolean',
            // 'venta_accion:boolean',
            // 'fusion_empresarial:boolean',
            // 'decreto_div_excedente:boolean',
            // 'modificacion_balance:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

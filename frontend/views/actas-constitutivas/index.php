<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActasConstitutivasSearch */
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
            // 'cierre_ejercicio_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'domicilio_fiscal_id',
            // 'domicilio_principal_id',
            // 'acciones:boolean',
            // 'certificados:boolean',
            // 'suplementarios:boolean',
            // 'capital_suscrito',
            // 'capital_pagado',
            // 'actual:boolean',
            // 'modificacion_acta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

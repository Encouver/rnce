<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasB1CuentasPorCobrarComercialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas B1 Cuentas Por Cobrar Comerciales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b1-cuentas-por-cobrar-comerciales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas B1 Cuentas Por Cobrar Comerciales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'concepto',
            'num_fact_contr',
            'monto',
            'porcentaje',
            // 'corriente:boolean',
            // 'nocorriente:boolean',
            // 'plazo_contrato_c',
            // 'saldo_c',
            // 'deterioro_c:boolean',
            // 'valor_de_uso_c',
            // 'saldo_neto_c',
            // 'plazo_contrato_nc',
            // 'saldo_nc',
            // 'deterioro_nc:boolean',
            // 'valor_de_uso_nc',
            // 'saldo_neto_nc',
            // 'intereses',
            // 'contratista_id',
            // 'anho',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

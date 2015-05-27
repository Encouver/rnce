<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasBb1CuentasPorPagarComercialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Bb1 Cuentas Por Pagar Comerciales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb1-cuentas-por-pagar-comerciales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Bb1 Cuentas Por Pagar Comerciales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'proveedor_id',
            'cantidad_factura',
            'saldo_al_cierre',
            'intereses_actividad_e',
            // 'corriente:boolean',
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

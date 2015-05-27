<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasB2OtrasCuentasPorCobrarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas B2 Otras Cuentas Por Cobrars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b2-otras-cuentas-por-cobrar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas B2 Otras Cuentas Por Cobrar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'criterio',
            'origen',
            'fecha',
            'garantia',
            // 'corriente:boolean',
            // 'nocorriente:boolean',
            // 'plazo_contrato_c',
            // 'saldo_neto_c',
            // 'plazo_contrato_nc',
            // 'saldo_neto_nc',
            // 'criterio_id',
            // 'otro_nombre',
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

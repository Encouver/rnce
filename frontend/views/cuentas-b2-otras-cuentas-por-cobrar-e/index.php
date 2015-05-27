<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasB2OtrasCuentasPorCobrarESearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas B2 Otras Cuentas Por Cobrar Es');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b2-otras-cuentas-por-cobrar-e-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas B2 Otras Cuentas Por Cobrar E'), ['create'], ['class' => 'btn btn-success']) ?>
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
            // 'saldo_c',
            // 'deterioro_c:boolean',
            // 'valor_de_uso_c',
            // 'saldo_neto_c',
            // 'plazo_contrato_nc',
            // 'saldo_nc',
            // 'deterioro_nc:boolean',
            // 'valor_de_uso_nc',
            // 'saldo_neto_nc',
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

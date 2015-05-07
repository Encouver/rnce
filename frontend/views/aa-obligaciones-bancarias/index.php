<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AaObligacionesBancariasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aa Obligaciones Bancarias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-obligaciones-bancarias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aa Obligaciones Bancarias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'corriente:boolean',
            'banco_id',
            'num_documento',
            'monto_otorgado',
            // 'fecha_prestamo',
            // 'fecha_vencimiento',
            // 'tasa_interes',
            // 'condicion_pago_id',
            // 'plazo',
            // 'tipo_garantia_id',
            // 'interes_ejer_econ',
            // 'interes_pagar',
            // 'importe_deuda',
            // 'total_imp_deu_int',
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

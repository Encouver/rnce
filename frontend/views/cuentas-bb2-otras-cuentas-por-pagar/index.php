<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasBb2OtrasCuentasPorPagarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Bb2 Otras Cuentas Por Pagars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb2-otras-cuentas-por-pagar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Bb2 Otras Cuentas Por Pagar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'criterio',
            'fecha',
            'garantia',
            'plazo',
            // 'saldo_conta_co',
            // 'saldo_conta_nc',
            // 'intereses',
            // 'criterio_id',
            // 'otro_nombre',
            // 'detalle:ntext',
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

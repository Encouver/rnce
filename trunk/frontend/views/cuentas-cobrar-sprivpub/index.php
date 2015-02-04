<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasCobrarSprivpubSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas Cobrar Sprivpubs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-sprivpub-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cuentas Cobrar Sprivpub', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'venta:boolean',
            'servicio:boolean',
            'obras:boolean',
            'num_contrato_factura',
            // 'monto_contrato_f',
            // 'procentaje_a',
            // 'plazo_contrato',
            // 'contatista_id',
            // 'ano',
            // 'tipo_cuenta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

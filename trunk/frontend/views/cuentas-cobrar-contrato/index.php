<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasCobrarContratoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas Cobrar Contratos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-contrato-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cuentas Cobrar Contrato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'condiciones',
            'num_contrato',
            'porcentaje_avance',
            'plazo_contrato',
            // 'saldo_cont_corriente',
            // 'saldo_cont_ncorriente',
            // 'contratista_id',
            // 'ano',
            // 'cliente_id',
            // 'contrato:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasCobroDudosoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cuentas Cobro Dudosos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobro-dudoso-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cuentas Cobro Dudoso', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'cliente_id',
            'cta_cobrar30',
            'cta_cobrar60',
            // 'cta_cobrar90',
            // 'cta_cobrar_m',
            // 'estimacion',
            // 'saldo_conta_corriente',
            // 'saldo_conta_ncorriente',
            // 'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

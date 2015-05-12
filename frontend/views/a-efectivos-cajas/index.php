<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AEfectivosCajasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aefectivos Cajas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-cajas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aefectivos Cajas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_caja_id',
            'saldo_cierre_ae',
            'tipo_moneda_id',
            'monto_me',
            // 'tipo_cambio_cierre',
            // 'nacional:boolean',
            // 'total_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'anho',
            // 'creado_por',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

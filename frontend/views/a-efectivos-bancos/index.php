<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AEfectivosBancosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aefectivos Bancos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-bancos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Aefectivos Bancos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'banco_contratista_id',
            'saldo_segun_b',
            'nd_no_cont',
            'depo_transito',
             'nc_no_cont',
             'cheques_transito',
             'saldo_al_cierre',
             'intereses_act_eco',
             'tipo_moneda_id',
             'monto_moneda_extra',
             'tipo_cambio_cierre',
            // 'creado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'anho',
            // 'total_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

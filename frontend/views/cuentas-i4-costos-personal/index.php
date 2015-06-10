<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasI4CostosPersonalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas I4 Costos Personals');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-i4-costos-personal-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas I4 Costos Personal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'monto_mano_directa',
            'metodo_inflacion_directa',
            'desde_directa',
            'hasta_directa',
            // 'mdo_ajustado_directa',
            // 'monto_mano_indirecta',
            // 'metodo_inflacion_indirecta',
            // 'desde_indirecta',
            // 'hasta_indirecta',
            // 'mdo_ajustado_indirecta',
            // 'concepto_id',
            // 'cp_objeto_id',
            // 'especifique',
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

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasCInventariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Cinventarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cinventarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Cinventarios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo_inventario_id',
            'detalle_inventario',
            'tecnica_medicion_id',
            'formula_tecnica_id',
            // 'inventario_inicial',
            // 'compra_ejercicio',
            // 'ventas_ejercicio',
            // 'inventario_final',
            // 'valor_neto_realizacion',
            // 'frecuencia_rotacion',
            // 'variacion_inflacion',
            // 'costo_ajustado',
            // 'deterioro',
            // 'reverso_deterioro',
            // 'valor_neto_ajus_cierre',
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

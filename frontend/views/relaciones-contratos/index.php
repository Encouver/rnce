<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RelacionesContratosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Relaciones Contratos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relaciones-contratos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Relaciones Contratos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'tipo_sector',
            'tipo_contrato',
            'nombre_proyecto',
            // 'fecha_inicio',
            // 'fecha_fin',
            // 'monto_contrato',
            // 'anticipo_recibido',
            // 'porcentaje_ejecucion',
            // 'evaluacion_ente',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosDatosImportacionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos Datos Importaciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-datos-importaciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Activos Datos Importaciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bien_id',
            'num_guia_nac',
            'costo_adquisicion',
            'gastos_mon_extranjera',
            // 'sys_divisa_id',
            // 'tasa_cambio',
            // 'gastos_imp_nacional',
            // 'otros_costros_imp_instalacion',
            // 'total_costo_adquisicion',
            // 'pais_origen_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

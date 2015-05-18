<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasEInversionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Einversiones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-einversiones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Einversiones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'empresa_relacionada_id',
            'corriente:boolean',
            'disponibilidad',
            'tipo_instrumento',
            // 'nombre_instrumento',
            // 'motivo_retiro',
            // 'numero_acc_bon',
            // 'e_inversion_info_adicional_id',
            // 'contratista_id',
            // 'anho',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'fecha_motivo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

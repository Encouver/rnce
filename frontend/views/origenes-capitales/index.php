<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrigenesCapitalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Origenes Capitales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origenes-capitales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Origenes Capitales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo_origen',
            'bien_id',
            'banco_contratista_id',
            'monto',
            // 'fecha',
            // 'saldo_cierre_anterior',
            // 'saldo_corte',
            // 'fecha_corte',
            // 'monto_aumento',
            // 'saldo_aumento',
            // 'numero_accion',
            // 'valor_acciones',
            // 'saldo_cierre_ajustado',
            // 'fecha_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
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

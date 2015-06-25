<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LimitacionesCapitalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Limitaciones Capitales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-capitales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Limitaciones Capitales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'afecta:boolean',
            'fecha_cierre',
            'capital_social',
            'total_patrimonio',
            // 'porcentaje_descapitalizacion',
            // 'supuesto:boolean',
            // 'monto_perdida',
            // 'fecha_limitacion',
            // 'capital_social_actualizado',
            // 'certificacion_aporte_id',
            // 'reintegro:boolean',
            // 'capital_legal',
            // 'saldo_perdida',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'fecha_informe',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'actual:boolean',
            // 'valor_accion',
            // 'valor_accion_comun',
            // 'total_accion',
            // 'total_accion_comun',
            // 'valor_accion_actual',
            // 'valor_accion_comun_actual',
            // 'capital_legal_actual',
            // 'total_capital',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>

</div>

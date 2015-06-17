<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PolizasContratadasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Polizas Contratadas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polizas-contratadas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
           [
                'attribute'=>'bien_id',
                'label'=>'Bien',
                'value'=>function($model){
                return $model->bien->Etiqueta();
                }
            ],
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
            'numero_contrato',
            'fecha_suscripcion',
            'fecha_inicio',
            'fecha_finalizacion',
            'duracion',
            'tipo_poliza',
            'monto_asegurado',
            'monto_contrato',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'natural_juridica_id',
            // 'bien_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
     <p>
        <?= Html::a(Yii::t('app', 'Create Polizas Contratadas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


</div>

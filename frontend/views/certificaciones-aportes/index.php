<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CertificacionesAportesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Certificaciones Aportes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificaciones-aportes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
            'tipo_profesion',
            'colegiatura',
            'fecha_informe',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'documento_registrado_id',
            // 'contratista_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
    <?php 
    if(!$model->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Certificacion de aportes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

</div>

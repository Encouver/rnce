<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuplementariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suplementarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suplementarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'suscrito:boolean',
            'capital',
            'numero',
            'valor',
            [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
            'fecha_informe',
            //'tipo_suplementario',
            
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
    if(!$model->existeregistro() && $model->validardenominacion()){ ?>
        <p>
        <?= Html::a(Yii::t('app', 'Crear Certificado Suplementario'), ['create','id'=>'principal'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
   

</div>

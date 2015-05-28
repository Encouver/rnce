<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesEconomicasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Actividades Economicas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-economicas-index">

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
                'attribute'=>'ppalcaev_id',
                'label'=>'Actividad Principal',
                'value'=>'ppalCaev.denominacion'
            ],
            
            'ppal_experiencia',
             [
                'attribute'=>'comp1_caev_id',
                'label'=>'Actividad Complementaria 1',
                'value'=>'comp1Caev.denominacion'
            ],
            'comp1_experiencia',
            [
                'attribute'=>'comp2_caev_id',
                'label'=>'Actividad Complementaria 2',
                'value'=>'comp2Caev.denominacion'
            ],
            'comp2_experiencia',
            //'contratista_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            //
            // 
            // 

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$model->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Actividades Economicas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

</div>

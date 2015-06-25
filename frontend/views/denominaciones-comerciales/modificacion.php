<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DenominacionesComercialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Denominaciones Comerciales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="denominaciones-comerciales-index">

    <?php
    if(isset($documento) && $documento->denominacion_comercial){
    echo Html::tag('h1','Cambio de Denominacion Comercial');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tipo_denominacion',
            'tipo_subdenominacion',
            ['attribute'=>'cooperativa_capital',
             'label'=>'Cooperativa Tipo Capital',
             'value'=>'cooperativa_capital'   
             ],
            ['attribute'=>'cooperativa_distribuicion',
             'label'=>'Cooperativa Tipo Distribucion',
             'value'=>'cooperativa_distribuicion'   
             ],
            'codigo_situr',
            //'contratista_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]);  if(!$searchModel->existeregistro()){ ?>
        <p>
        <?= Html::a(Yii::t('app', 'Crear Denominacion Comercial'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al cambio de denominacion comercial activo </h4>

            </div>
        <?php } ?>
</div>

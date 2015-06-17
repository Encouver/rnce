<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-pagocapital">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php
    if(isset($documento) && $documento->venta_accion){
    echo Html::tag('h1','Venta de Acciones');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'suscrito:boolean',
            'total_venta',
            'numero_preferencial',
            'valor_preferencial',
            'numero_comun',
            'valor_comun',
            
           // 'valor_comun',
            //'numero_preferencial',
            //'valor_preferencial',
        
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'tipo_accion',
            
            // 'acta_constitutiva_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); 
       
         if(!$searchModel->existeregistro()){ ?>
                <p>
                     <?=Html::a(Yii::t('app', 'Agregar Venta Accion'), ['create','id'=>'venta'], ['class' => 'btn btn-success']) ?>

             </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a la venta de acciones activo</h4>

            </div>
        <?php } ?>
    

</div>

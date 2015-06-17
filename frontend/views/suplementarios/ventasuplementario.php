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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?php
    if(isset($documento) && $documento->venta_accion){
    echo Html::tag('h1','Venta de Certificados Suplementarios');
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'suscrito:boolean',
           'total_venta',
            'numero',
            'valor',
            //'valor',
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
    ]); 
    if(!$searchModel->existeregistro()){ ?>
    <p>
        <?= Html::a(Yii::t('app', 'Agregar Venta de certificados'), ['create','id'=>'venta'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a la venta de certificados suplementarios activo</h4>

            </div>
        <?php } ?>

       
  
   

</div>

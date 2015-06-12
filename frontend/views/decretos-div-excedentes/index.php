<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DecretosDivExcedentesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Decretos Div Excedentes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decretos-div-excedentes-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php
    if(isset($documento) && $documento->decreto_div_excedente){
    echo Html::tag('h1','Decreto de Dividendos en Efectivo');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fecha_cierre',
            'utilidad_acumulada',
            'utilidad_decretada',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]);
       if(!$searchModel->existeregistro() && $documento->decreto_div_excedente){ ?>
            
     <p>
        <?= Html::a(Yii::t('app', 'Crear Dividendos en Efectivo'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php } 
         
         
         if(!$searchModelPago->existeregistro()){
             echo Html::tag('hr');
             echo Html::tag('h3','Pagos Accionistas');
            echo GridView::widget([
        'dataProvider' => $dataProviderPago,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Accionista',
                'value'=>'naturalJuridica.denominacion',
            ],
            'tipo_pago',
            'numero',
            
           // 'decreto_div_excedente_id',
            'monto_cancelado',
            'fecha',
            //'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'tipo_pago',
            // 'numero',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}', 'controller'=>'pagos-accionistas-decretos'],
        ],
    ]);?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Pagos Accionistas Decretos'), ['pagos-accionistas-decretos/create'], ['class' => 'btn btn-success']) ?>
    </p>
             
    <?php     } 
         
         
       }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a Decreto de Dividendos en Efectivo</h4>

            </div>
        <?php } ?>
</div>

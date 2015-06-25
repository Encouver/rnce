<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CierresEjerciciosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cierres Ejercicios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cierres-ejercicios-index">
    
 <?php
    if(isset($documento) && $documento->cierre_ejercicio){
    echo Html::tag('h1','Cambio de Cierre del Ejercicio Economico');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'contratista_id',
            //'documento_registrado_id',
              [
               'attribute'=>'documento_registrado_id',
               'label'=>'Tipo documento',
               'value'=>'documentoRegistrado.tipoDocumento.nombre',
               ],
            'fecha_cierre',
            //'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); 
         if(!$searchModel->existeregistro()){ ?>
                <p>
        <?= Html::a(Yii::t('app', 'Agregar Cierre Ejercicio'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al cambio del cierre del ejercicio economico </h4>

            </div>
        <?php } ?>

</div>

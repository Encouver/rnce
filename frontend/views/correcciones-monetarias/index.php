<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CorreccionesMonetariasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Correcciones Monetarias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correcciones-monetarias-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?php
 if(isset($documento) && $documento->coreccion_monetaria){
    echo Html::tag('h1','Incremento por Correccion Monetaria');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
       'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'monto_capital_legal',
            'valor_accion',
            'variacion_valor',
            'total_accion',
            'valor_accion_comun',
            'variacion_valor_comun',
            'total_accion_comun',
            'fecha_aumento',
            [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
            //'fecha_informe',
            // 'monto_capital_legal',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'certificacion_aporte_id',
            // 'fecha_informe',
            // 'valor_accion_comun',
            // 'variacion_valor_comun',
            // 'total_accion_comun',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); if(!$searchModel->existeregistro() && $documento->coreccion_monetaria){ ?>
            
   
    <p>
        <?= Html::a(Yii::t('app', 'Create Correcciones Monetarias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a incremento por correccion monetaria activo</h4>

            </div>
        <?php } ?>
</div>

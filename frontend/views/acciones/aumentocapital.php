<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-aumentocapital">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?php
    if(isset($documento) && $documento->aumento_capital){
    echo Html::tag('h1','Aumento de Capital');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'suscrito:boolean',
            'capital',
            'numero_comun',
            
           'valor_comun',
            'numero_preferencial',
            'valor_preferencial',
            [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
            'fecha_informe',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'tipo_accion',
            
            // 'acta_constitutiva_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); 
       
         if(!$searchModel->existeregistro() && $searchModel->Pagocompleto()){ ?>
                <p>
                     <?=Html::a(Yii::t('app', 'Agregar Aumento de Capital'), ['create','id'=>'aumento'], ['class' => 'btn btn-success']) ?>

             </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al aumento de capital activo</h4>

            </div>
        <?php } ?>
    

</div>

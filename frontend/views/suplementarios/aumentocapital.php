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

   <?php
    if(isset($documento)){
    echo Html::tag('h1','Aumento de Capital');
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'suscrito:boolean',
            'capital',
            'numero',
             [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
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
    if(!$searchModel->existeregistro() && $searchModel->Pagocompleto()){ ?>
    <p>
        <?= Html::a(Yii::t('app', 'Agregar Aumento de Capital'), ['create','id'=>'aumento'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al aumento de capital activo</h4>

            </div>
        <?php } ?>

       
  
   

</div>

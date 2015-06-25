<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RazonesSocialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Razones Sociales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="razones-sociales-index">
   
 <?php
    if(isset($documento) && $documento->razon_social){
    echo Html::tag('h1','Cambio de Nombre o Razon Social');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'contratista_id',
            'nombre',
            //'creado_por',
            //'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'documento_registrado_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); if(!$searchModel->existeregistro()){ ?>
         <p>
        <?= Html::a(Yii::t('app', 'Agregar Razon Social'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al nombre o razon social activo </h4>

            </div>
        <?php } ?>
  
</div>

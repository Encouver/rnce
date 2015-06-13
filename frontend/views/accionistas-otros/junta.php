<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionistasOtrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accionistas Otros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accionistas-otros-junta">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <?php
    if(isset($documento) && $documento->junta_directiva){
    echo Html::tag('h1','Actualizacion de la Junta Directiva');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
            'tipo_cargo',
            'tipo_obligacion',
            'accionista:boolean',
            'junta_directiva:boolean',
            
            //'contratista_id',
           // 'natural_juridica_id',
            //'valor_compra',
            // 'fecha',
            // 'accionista:boolean',
            // 'junta_directiva:boolean',
            // 'rep_legal:boolean',
            // 'documento_registrado_id',
            // 'repr_legal_vigencia',
            // 'empresa_fusionada_id',
            // 'tipo_obligacion',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'empresa_relacionada:boolean',
            // 'tipo_cargo',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]);
       if(!$searchModel->existeregistro('junta')){ ?>
   <p>
        <?= Html::a(Yii::t('app', 'Agregar Junta DIrectiva'), ['create','id'=>'junta'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a la Actualizacion de la Junta Directiva activo</h4>

            </div>
        <?php } ?>
     

</div>

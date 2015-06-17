<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuplementariosDisminuidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Suplementarios Disminuidos');
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  <?php
    if(isset($documento) && $documento->disminucion_capital){
    echo Html::tag('h1','Disminucion del Capital');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
           'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'justificacion:ntext',
            'capital_social',
            'tipo_disminucion',
            'valor',
            'numero',
            // 'valor_actual',
            // 'numero_actual',
            // 'capital_social',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'actual:boolean',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); 
       if(!$searchModel->existeregistro() && $documento->disminucion_capital){ ?>
   <p>
        <?= Html::a(Yii::t('app', 'Sobre el valor'), ['create','id'=>'valor'], ['class' => 'btn btn-success']) ?> <?= Html::a(Yii::t('app', 'Sobre el numero'), ['create','id'=>'cantidad'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a disminucionde capital activo</h4>

            </div>
        <?php } ?>
</div>

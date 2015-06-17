<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CertificadosDisminuidosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Certificados Disminuidos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-disminuidos-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
    if(isset($documento) && $documento->disminucion_capital){
    echo Html::tag('h1','Disminucion del Capital');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
           'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'justificacion:ntext',
            'tipo_disminucion',
            'capital_social',
            'numero_asociacion',
            'numero_aportacion',
            'numero_rotativo',
            'numero_inversion',
            'valor_asociacion',
            'valor_aportacion',
            'valor_rotativo',
            'valor_inversion',
            // 'valor_asociacion_actual',
            // 'valor_aportacion_actual',
            // 'valor_rotativo_actual',
            // 'valor_inversion_actual',
            // 'numero_asoacion_actual',
            // 'numero_aportacion_actual',
            // 'numero_rotativo_actual',
            // 'numero_inversion_actual',
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

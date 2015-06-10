<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CertificadosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Certificados');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-pagocapital">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?php
      if(isset($documento)){
      echo Html::tag('h1','Pago de Capital');
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'capital',
            'numero_asociacion',
            'numero_aportacion',
            'numero_inversion',
            'numero_rotativo',
            [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
            'fecha_informe',
            // 'tipo_certificado',
            // 'suscrito:boolean',
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
            <?= Html::a(Yii::t('app', 'Agregar Pago Capital'), ['create','id'=>'pago'], ['class' => 'btn btn-success']) ?>
        </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al pago de capital activo</h4>

            </div>
        <?php } ?>
     


   
</div>

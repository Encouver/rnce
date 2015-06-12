<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FondosEmergenciasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Fondos Emergencias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondos-emergencias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
    if(isset($documento) && $documento->fondo_emergencia){
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fecha_cierre',
            'saldo_fondo',
            'monto_perdida',
            'monto_utilizado',
            'monto_asociados',
            //'corto_plazo:boolean',
            // 'numero_plazo',
            // 'interes:boolean',
            // 'tasa_interes',
            // 'saldo_fondo_actual',
            // 'monto_actual',
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
    if(!$searchModel->existeregistro() && $documento->fondo_emergencia){ ?>
            
    <p>
        <?= Html::a(Yii::t('app', 'Create Fondos Emergencias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a fondo de emergencia activo</h4>

            </div>
        <?php } ?>
</div>

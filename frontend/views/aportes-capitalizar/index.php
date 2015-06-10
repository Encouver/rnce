<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AportesCapitalizarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Aportes Capitalizars');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aportes-capitalizar-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<?php
    if(isset($documento) && $documento->aporte_capitalizar){
    echo Html::tag('h1','Aporte por capitalizar');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'monto_aporte',
            'fecha_capitalizacion',
            [
                'attribute'=>'certificacion_aporte_id',
                'label'=>'Certificador Aporte',
                'value'=>'certificacionAporte.naturalJuridica.denominacion'
            ],
            'fecha_informe',
            //'creado_por',
            //'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'certificacion_aporte_id',
            // 'fecha_informe',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]);
       if(!$searchModel->existeregistro() && $documento->aporte_capitalizar){ ?>
            
    <p>
        <?= Html::a(Yii::t('app', 'Agregar Aportes Capitalizar'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a aportes por capitalizar activo</h4>

            </div>
        <?php } ?>
</div>

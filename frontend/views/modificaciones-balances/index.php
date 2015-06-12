<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModificacionesBalancesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modificaciones Balances');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificaciones-balances-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

  
<?php
    if(isset($documento) && $documento->modificacion_balance){
        echo Html::tag('h1', 'Discusión y Aprobación o Modificación de Balances');
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            'fecha_cierre',
            'aprobado:boolean',
            //'creado_por',
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
    if(!$searchModel->existeregistro() && $documento->modificacion_balance){ ?>
            
      <p>
        <?= Html::a(Yii::t('app', 'Agregar Discusión y Aprobación o Modificación de Balances'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a Discusión y Aprobación o Modificación de Balances activo</h4>

            </div>
        <?php } ?>
</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DuracionesEmpresasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Duraciones Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duraciones-empresas-index">

    <?php
    if(isset($documento) && $documento->duracion_empresa){
    echo Html::tag('h1','Prorroga de Duracion de la Empresa');
       echo GridView::widget([
        'dataProvider' => $dataProvider,
        'summary'=>'',
        //s'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'contratista_id',
            //'documento_registrado_id',
             [
               'attribute'=>'documento_registrado_id',
               'label'=>'Tipo documento',
               'value'=>'documentoRegistrado.tipoDocumento.nombre',
               ],
            'duracion_anos',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]);
         if(!$searchModel->existeregistro()){ ?>
         <p>
        <?= Html::a(Yii::t('app', 'Agregar Duracion Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
      
         <?php }  }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente a la duracion de la empresa activo </h4>

            </div>
        <?php } ?>

</div>

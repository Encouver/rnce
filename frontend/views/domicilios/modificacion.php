<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DomiciliosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Domicilios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilios-index">

   
   <?php
    if(isset($documento) && $documento->domicilio_fiscal){
    echo Html::tag('h1','Direccion Fiscal');
    echo GridView::widget([
        'dataProvider' => $dataProviderFiscal,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
              [
               'attribute'=>'documento_registrado_id',
               'label'=>'Tipo documento',
               'value'=>'documentoRegistrado.tipoDocumento.nombre',
               ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Estado',
                'value'=>'direccion.sysEstado.nombre'
            ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Municipio',
                'value'=>'direccion.sysMunicipio.nombre'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Parroquia',
                'value'=>'direccion.sysParroquia.nombre'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Sector / Zona / Urbanizacion',
                'value'=>'direccion.zona'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Avenida / Calle / Esquina',
                'value'=>'direccion.calle'
            ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Edif. / Casa / C.C',
                'value'=>'direccion.casa'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Piso / Nivel',
                'value'=>'direccion.nivel'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Numero',
                'value'=>'direccion.numero'
            ],
            
            //'id',
            //'contratista_id',
            //'documento_registrado_id',
            //'sys_status:boolean',
            //'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'fiscal:boolean',
            // 'direccion_id',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
    <?php 
    if(!$searchModelFiscal->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agreagar Direccion Fiscal'), ['create','id'=>'fiscal'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <br />
    <h2>Direccion Principal</h2>

    <?= GridView::widget([
        'dataProvider' => $dataProviderPrincipal,
        'summary'=>'',
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
              [
               'attribute'=>'documento_registrado_id',
               'label'=>'Tipo documento',
               'value'=>'documentoRegistrado.tipoDocumento.nombre',
               ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Estado',
                'value'=>'direccion.sysEstado.nombre'
            ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Municipio',
                'value'=>'direccion.sysMunicipio.nombre'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Parroquia',
                'value'=>'direccion.sysParroquia.nombre'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Sector / Zona / Urbanizacion',
                'value'=>'direccion.zona'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Avenida / Calle / Esquina',
                'value'=>'direccion.calle'
            ],
            [
                'attribute'=>'direccion_id',
                'label'=>'Edif. / Casa / C.C',
                'value'=>'direccion.casa'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Piso / Nivel',
                'value'=>'direccion.nivel'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Numero',
                'value'=>'direccion.numero'
            ],
             [
                'attribute'=>'direccion_id',
                'label'=>'Pto. Referencia',
                'value'=>'direccion.referencia'
            ],
            
            //'id',
            //'contratista_id',
            //'documento_registrado_id',
            //'sys_status:boolean',
            //'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'fiscal:boolean',
            // 'direccion_id',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$searchModelPrincipal->existeregistro()){ ?>
        <p>
        <?= Html::a(Yii::t('app', 'Agreagar Direccion Principal'), ['create','id'=>'principal'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
     <?php }else{?>
        
            <div class="alert-warning alert fade in">
               

                <h4>No existe ningun procedimiento referente al cambio de domicilio activo</h4>

            </div>
        <?php } ?>

   

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetosEmpresasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objetos Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-empresas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

     <br />
    <h3>Objetos No Autorizados</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            'objeto_empresa',
            //'id',
            //'contratista:boolean',
            //'empresa_relacionada_id',
            //'contratista_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            //($searchModel->contratista)?['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}']:['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}{update}']
           ['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}']
        ],
    ]); ?>
    <p>
        <?= Html::a(Yii::t('app', 'Añadir Objetos'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
     <br />
     <br />
    <h3>Objetos Autorizados</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProviderAutorizado,
        //'filterModel' => $searchModelAutorizado,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tipo_objeto',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Fabricante',
                'value'=>'naturalJuridica.denominacion'
            ],
            [
                'attribute'=>'domicilio_fabricante_id',
                'label'=>'Domicilio Fabrcante',
                'value'=>'domicilioFabricante.nombre'
            ],
           // 'domicilio_fabricante_id',
            'productos:ntext',
            'marcas:ntext',
            [
                'attribute'=>'origen_producto_id',
                'label'=>'Origen Producto',
                'value'=>'origenProducto.nombre'
            ],
            //'origen_producto_id',
            // 'sello_firma:boolean',
            // 'idioma_redacion_id',
            // 'documento_traducido:boolean',
            // 'numero_identificacion',
            // 'nombre_interprete',
            // 'fecha_emision',
            // 'fecha_vencimiento',
            
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{delete}','controller'=>'objetos-autorizaciones'],
        ],
    ]); ?>
     <p>
        <?= Html::a(Yii::t('app', 'Añadir Objetos Autorizados'), ['objetos-autorizaciones/create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

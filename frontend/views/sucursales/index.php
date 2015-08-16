<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SucursalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sucursales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sucursales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Persona de contacto',
                'value'=>'naturalJuridica.denominacion'
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
            //'direccion_id',
            //'contratista_id',
            //'id',
            //'creado_por',
            //'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <p>
        <?= Html::a(Yii::t('app', 'Agregar Sucursal'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

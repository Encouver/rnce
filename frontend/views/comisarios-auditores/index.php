<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComisariosAuditoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Comisarios Auditores');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comisarios-auditores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre comisario',
                'value'=>'naturalJuridica.denominacion'
            ],
            'tipo_profesion',
            'fecha_carta',
            'fecha_vencimiento',
            //'id',
            //'declaracion_jurada:boolean',
            // 'colegiatura',
            // 'documento_registrado_id',
            // 'contratista_id',
            // 'comisario:boolean',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'auditor:boolean',
            // 'responsable_contabilidad:boolean',
            // 'informe_conversion:boolean',
            // 'natural_juridica_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
       <?php 
    if(!$searchModel->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Comisario'), ['create','id'=>'comisario'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

</div>

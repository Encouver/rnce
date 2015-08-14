<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DuracionesEmpresasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Duración empresa');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duraciones-empresas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
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
    ]); ?>
     <?php 
    if(!$model->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Duracion Empresa'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

</div>

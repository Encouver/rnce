<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DenominacionesComercialesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Denominaciones Comerciales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="denominaciones-comerciales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

 

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tipo_denominacion',
            'tipo_subdenominacion',
            ['attribute'=>'cooperativa_capital',
             'label'=>'Cooperativa Tipo Capital',
             'value'=>'cooperativa_capital'   
             ],
            ['attribute'=>'cooperativa_distribuicion',
             'label'=>'Cooperativa Tipo Distribucion',
             'value'=>'cooperativa_distribuicion'   
             ],
            'codigo_situr',
            //'contratista_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
       <p>
        <?= Html::a(Yii::t('app', 'Crear Denominacion Comercial'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
</div>

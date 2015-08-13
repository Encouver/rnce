<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BancosContratistasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bancos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bancos-contratistas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
         'summary'=>"",
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'banco_id',
                'label'=>'Banco',
                'value'=>'banco.nombre'
            ],
            'num_cuenta',
            [
                'attribute'=>'banco_id',
                'label'=>'Pais',
                'value'=>'banco.sysPais.nombre'
            ],
            
            'tipo_moneda',
            'tipo_cuenta',
            'estatus_cuenta',
            // 'estatus_cuenta',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

             ['class' => 'yii\grid\ActionColumn', 'template' => '{update}'],
        ],
    ]); ?>
 <p>
        <?= Html::a(Yii::t('app', 'Crear Bancos Contratistas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

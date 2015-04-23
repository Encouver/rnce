<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modelsDireccionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Direcciones');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="direcciones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Direcciones'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'zona',
            'calle',
            'casa',
            'nivel',
            // 'numero',
            // 'referencia:ntext',
            // 'sys_estado_id',
            // 'sys_municipio_id',
            // 'sys_parroquia_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

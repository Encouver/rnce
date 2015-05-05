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

    <p>
        <?= Html::a(Yii::t('app', 'Create Denominaciones Comerciales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'codigo_situr',
            'cooperativa_capital',
            'cooperativa_distribuicion',
            'contratista_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'tipo_denominacion',
            // 'tipo_subdenominacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

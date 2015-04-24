<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActividadesEconomicasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Actividades Economicas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-economicas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Actividades Economicas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ppal_caev_id',
            'comp1_caev_id',
            'comp2_caev_id',
            'contratista_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'ppal_experiencia',
            // 'comp1_experiencia',
            // 'comp2_experiencia',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

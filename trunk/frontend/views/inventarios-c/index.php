<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InventariosCSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inventarios Cs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventarios-c-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inventarios C', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tecnica_medicion',
            'formula_calculo',
            'costo_adquisicion',
            'ajuste_inflacion',
            // 'reservo_deterioro',
            // 'contratista_id',
            // 'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

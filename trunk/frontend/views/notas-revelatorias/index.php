<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NotasRevelatoriasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notas Revelatorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-revelatorias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Notas Revelatorias', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nota:ntext',
            'usuario_id',
            'contratista_id',
            'ano',
            // 'cuenta',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

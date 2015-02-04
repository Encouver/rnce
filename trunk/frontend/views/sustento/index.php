<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SustentoContsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sustento Conts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sustento-conts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Sustento Conts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'descripcion',
            'tipo_sustento_id',
            'contratista_id',
            'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\VariablesGlobalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Variables Globales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variables-globales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Variables Globales', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'campo',
            'cuenta_afectada',
            'valor',
            // 'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

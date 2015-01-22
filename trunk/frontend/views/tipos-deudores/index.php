<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposDeudoresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos Deudores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-deudores-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipos Deudores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'descripción',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

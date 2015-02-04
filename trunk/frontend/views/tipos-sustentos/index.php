<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TiposSustentosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos Sustentos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-sustentos-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tipos Sustentos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'tipo_cuenta',
            'activo:boolean',
            'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

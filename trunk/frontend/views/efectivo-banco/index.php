<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EfectivoBancoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Efectivo Bancos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="efectivo-banco-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Efectivo Banco', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'banco_id',
            'saldo_banco',
            'depos_transito',
            // 'saldo_contabilidad',
            // 'che_transito',
            // 'nd_contabilizadas',
            // 'nc_contabilizadas',
            // 'ano',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

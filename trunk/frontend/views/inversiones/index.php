<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InversionesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inversiones';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inversiones-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Inversiones', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'banco_id',
            'costo_adquisicion',
            'valor_desvalorizacion',
            'contratista_id',
            // 'ano',
            // 'activo:boolean',
            // 'plazo',
            // 'tasa_interes',
            // 'tipo_inversion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OtrasCuentasCobrarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Otras Cuentas Cobrars';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otras-cuentas-cobrar-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Otras Cuentas Cobrar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo_deudor_id',
            'nombre',
            'origen',
            'fecha',
            // 'garantia',
            // 'plazo',
            // 'ano',
            // 'contratista_id',
            // 'activo:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

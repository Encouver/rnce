<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasBb2GarantiasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Bb2 Garantias');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb2-garantias-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Bb2 Garantias'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'classname_id',
            'tipo',
            'contratista_id',
            'anho',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

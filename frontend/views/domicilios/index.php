<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DomiciliosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Domicilios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Domicilios'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista_id',
            'documento_registrado_id',
            'sys_status:boolean',
            'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'fiscal:boolean',
            // 'direccion_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

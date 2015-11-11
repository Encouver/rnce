<?php

use kartik\dynagrid\DynaGrid;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ActivosIntangiblesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Activos Activos Intangibles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-activos-intangibles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!--
    <p>
        <?/*= Html::a(Yii::t('app', 'Create Activos Activos Intangibles'), ['create'], ['class' => 'btn btn-success']) */?>
    </p>

    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'bien_id',
            'certificado_registro',
            'fecha_registro',
            'vigencia',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

    -->


</div>

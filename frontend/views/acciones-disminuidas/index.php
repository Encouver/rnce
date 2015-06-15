<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionesDisminuidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Acciones Disminuidas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-disminuidas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Acciones Disminuidas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'justificacion:ntext',
            'tipo_disminucion',
            'valor_comun',
            'valor_preferencial',
            // 'numero_comun',
            // 'numero_preferencial',
            // 'acta_constitutiva_id',
            // 'valor_comun_actual',
            // 'valor_preferencial_actual',
            // 'numero_comun_actual',
            // 'numero_preferencial_actual',
            // 'capital_social',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'actual:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

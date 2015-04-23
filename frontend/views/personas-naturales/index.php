<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonasNaturalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Personas Naturales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-naturales-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Personas Naturales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'primer_nombre',
            'segundo_nombre',
            'rif',
            'ci',
            // 'creado_por',
            // 'primer_apellido',
            // 'segundo_apellido',
            // 'telefono_local',
            // 'telefono_celular',
            // 'fax',
            // 'correo',
            // 'pagina_web',
            // 'facebook',
            // 'twitter',
            // 'instagram',
            // 'sys_pais_id',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'numero_identificacion',
            // 'nacionalidad',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

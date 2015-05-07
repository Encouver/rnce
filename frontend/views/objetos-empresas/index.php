<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetosEmpresasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Objetos Empresas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-empresas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Objetos Empresas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'contratista:boolean',
            'empresa_relacionada_id',
            'sys_status:boolean',
            'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'productor:boolean',
            // 'fabricante:boolean',
            // 'fabricante_importado:boolean',
            // 'distribuidor:boolean',
            // 'distribuidor_autorizado:boolean',
            // 'distribuidor_importador:boolean',
            // 'dist_importador_aut:boolean',
            // 'servicio_basico:boolean',
            // 'servicio_profesional:boolean',
            // 'servicio_comercial:boolean',
            // 'ser_comercial_aut:boolean',
            // 'obra:boolean',
            // 'contratista_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

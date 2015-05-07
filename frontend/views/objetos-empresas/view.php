<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosEmpresas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-empresas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contratista:boolean',
            'empresa_relacionada_id',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'productor:boolean',
            'fabricante:boolean',
            'fabricante_importado:boolean',
            'distribuidor:boolean',
            'distribuidor_autorizado:boolean',
            'distribuidor_importador:boolean',
            'dist_importador_aut:boolean',
            'servicio_basico:boolean',
            'servicio_profesional:boolean',
            'servicio_comercial:boolean',
            'ser_comercial_aut:boolean',
            'obra:boolean',
            'contratista_id',
        ],
    ]) ?>

</div>

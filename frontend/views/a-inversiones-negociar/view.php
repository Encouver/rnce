<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\c\AInversionesNegociar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ainversiones Negociars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ainversiones-negociar-view">

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
            'banco_id',
            'fecha_inversion',
            'fecha_finalizacion',
            'tasa',
            'plazo',
            'costo_adquisicion',
            'valorizacion',
            'saldo_al_cierre',
            'intereses_act_eco',
            'tipo_moneda_id',
            'monto_moneda_extra',
            'tipo_cambio_cierre',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'contratista_id',
            'anho',
            'creado_por',
            'total_id',
        ],
    ]) ?>

</div>

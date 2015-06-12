<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\FondosEmergencias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondos Emergencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondos-emergencias-view">

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
            'fecha_cierre',
            'saldo_fondo',
            'monto_perdida',
            'monto_utilizado',
            'monto_asociados',
            'corto_plazo:boolean',
            'numero_plazo',
            'interes:boolean',
            'tasa_interes',
            'saldo_fondo_actual',
            'monto_actual',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'contratista_id',
            'documento_registrado_id',
        ],
    ]) ?>

</div>

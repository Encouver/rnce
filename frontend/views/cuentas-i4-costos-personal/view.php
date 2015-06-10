<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI4CostosPersonal */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas I4 Costos Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-i4-costos-personal-view">

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
            'monto_mano_directa',
            'metodo_inflacion_directa',
            'desde_directa',
            'hasta_directa',
            'mdo_ajustado_directa',
            'monto_mano_indirecta',
            'metodo_inflacion_indirecta',
            'desde_indirecta',
            'hasta_indirecta',
            'mdo_ajustado_indirecta',
            'concepto_id',
            'cp_objeto_id',
            'especifique',
            'contratista_id',
            'anho',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
        ],
    ]) ?>

</div>

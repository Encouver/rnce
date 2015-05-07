<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\c\AaObligacionesBancarias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aa Obligaciones Bancarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-obligaciones-bancarias-view">

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
            'corriente:boolean',
            'banco_id',
            'num_documento',
            'monto_otorgado',
            'fecha_prestamo',
            'fecha_vencimiento',
            'tasa_interes',
            'condicion_pago_id',
            'plazo',
            'tipo_garantia_id',
            'interes_ejer_econ',
            'interes_pagar',
            'importe_deuda',
            'total_imp_deu_int',
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

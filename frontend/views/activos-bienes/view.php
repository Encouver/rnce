<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosBienes */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Bienes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-bienes-view">

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
            'sys_tipo_bien_id',
            'detalle',
            'fecha_origen',
            'contratista_id',
            'propio:boolean',
            'origen_id',
            'nacional:boolean',
            'carga_completa:boolean',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'factura_id',
            'documento_registrado_id',
            'arrendamiento_id',
            'desincorporacion_id',
            'mejora:boolean',
            'perdida_reverso:boolean',
            'proc_productivo:boolean',
            'directo:boolean',
            'proc_ventas:boolean',
            'metodo_medicion_id',
        ],
    ]) ?>

</div>

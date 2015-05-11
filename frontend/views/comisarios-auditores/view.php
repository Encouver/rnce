<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\ComisariosAuditores */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comisarios Auditores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comisarios-auditores-view">

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
            'fecha_vencimiento',
            'declaracion_jurada:boolean',
            'tipo_profesion',
            'fecha_carta',
            'colegiatura',
            'documento_registrado_id',
            'contratista_id',
            'comisario:boolean',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'auditor:boolean',
            'responsable_contabilidad:boolean',
            'informe_conversion:boolean',
            'natural_juridica_id',
        ],
    ]) ?>

</div>

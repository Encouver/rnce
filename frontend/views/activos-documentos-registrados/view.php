<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDocumentosRegistrados */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Documentos Registrados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-documentos-registrados-view">

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
            'contratista_id',
            'sys_tipo_registro_id',
            'num_registro_notaria',
            'tomo',
            'folio',
            'fecha_registro',
            'fecha_asamblea',
            'sys_circunscripcion_id',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'valor_adquisicion',
            'tipo_documento_id',
        ],
    ]) ?>

</div>

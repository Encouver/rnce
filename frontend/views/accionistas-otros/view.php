<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accionistas Otros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accionistas-otros-view">

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
            'natural_juridica_id',
            'porcentaje_accionario',
            'valor_compra',
            'fecha',
            'accionista:boolean',
            'junta_directiva:boolean',
            'rep_legal:boolean',
            'cargo',
            'documento_registrado_id',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'repr_legal_vigencia',
            'empresa_fusionada_id',
            'tipo_obligacion',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\AccionesDisminuidas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acciones Disminuidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-disminuidas-view">

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
            'justificacion:ntext',
            'tipo_disminucion',
            'valor_comun',
            'valor_preferencial',
            'numero_comun',
            'numero_preferencial',
            'valor_comun_actual',
            'valor_preferencial_actual',
            'numero_comun_actual',
            'numero_preferencial_actual',
            'capital_social',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'contratista_id',
            'documento_registrado_id',
            'actual:boolean',
        ],
    ]) ?>

</div>

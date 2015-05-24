<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\Certificados */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-view">

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
            'numero_asociacion',
            'numero_aportacion',
            'numero_rotativo',
            'numero_inversion',
            'valor_asociacion',
            'valor_aportacion',
            'valor_rotativo',
            'valor_inversion',
            'tipo_certificado',
            'suscrito:boolean',
            'documento_registrado_id',
            'contratista_id',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'capital',
        ],
    ]) ?>

</div>

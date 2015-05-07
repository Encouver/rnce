<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Autorizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-autorizaciones-view">

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
            'objeto_empresa_id',
            'domicilio_fabricante_id',
            'productos:ntext',
            'marcas:ntext',
            'origen_producto_id',
            'sello_firma:boolean',
            'idioma_redacion_id',
            'documento_traducido:boolean',
            'numero_identificacion',
            'nombre_interprete',
            'fecha_emision',
            'fecha_vencimiento',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'persona_juridica_id',
            'tipo_objeto',
        ],
    ]) ?>

</div>

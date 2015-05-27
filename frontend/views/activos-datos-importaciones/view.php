<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDatosImportaciones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Datos Importaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-datos-importaciones-view">

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
           // 'id',
            'bien_id',
            'num_guia_nac',
            'costo_adquisicion',
            'gastos_mon_extranjera',
            'sys_divisa_id',
            'tasa_cambio',
            'gastos_imp_nacional',
            'otros_costros_imp_instalacion',
            'total_costo_adquisicion',
            'pais_origen_id',
//            'sys_status:boolean',
//            'sys_creado_el',
//            'sys_actualizado_el',
//            'sys_finalizado_el',
        ],
    ]) ?>

</div>

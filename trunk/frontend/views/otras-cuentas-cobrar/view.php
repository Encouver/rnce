<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\OtrasCuentasCobrar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Otras Cuentas Cobrars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otras-cuentas-cobrar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo_deudor_id',
            'nombre',
            'origen',
            'fecha',
            'garantia',
            'plazo',
            'ano',
            'contratista_id',
            'activo:boolean',
        ],
    ]) ?>

</div>

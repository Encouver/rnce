<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EfectivoBanco */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Efectivo Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="efectivo-banco-view">

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
            'contratista_id',
            'banco_id',
            'saldo_banco',
            'depos_transito',
            'saldo_contabilidad',
            'che_transito',
            'nd_contabilizadas',
            'nc_contabilizadas',
            'ano',
        ],
    ]) ?>

</div>

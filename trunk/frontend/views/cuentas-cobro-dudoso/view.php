<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobroDudoso */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobro Dudosos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobro-dudoso-view">

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
            'cliente_id',
            'cta_cobrar30',
            'cta_cobrar60',
            'cta_cobrar90',
            'cta_cobrar_m',
            'estimacion',
            'saldo_conta_corriente',
            'saldo_conta_ncorriente',
            'ano',
        ],
    ]) ?>

</div>

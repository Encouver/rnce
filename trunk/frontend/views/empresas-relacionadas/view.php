<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresasRelacionadas */

$this->title = $model->empresa_id;
$this->params['breadcrumbs'][] = ['label' => 'Empresas Relacionadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-relacionadas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'empresa_id' => $model->empresa_id, 'contratista_id' => $model->contratista_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'empresa_id' => $model->empresa_id, 'contratista_id' => $model->contratista_id], [
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
            'empresa_id',
            'contratista_id',
            'otras_cuentas_pagar_id',
            'participacion',
        ],
    ]) ?>

</div>

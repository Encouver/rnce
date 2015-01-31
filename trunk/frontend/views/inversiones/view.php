<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Inversiones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inversiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inversiones-view">

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
            'banco_id',
            'costo_adquisicion',
            'valor_desvalorizacion',
            'contratista_id',
            'ano',
            'activo:boolean',
            'plazo',
            'tasa_interes',
            'tipo_inversion',
        ],
    ]) ?>

</div>

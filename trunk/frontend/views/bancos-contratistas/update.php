<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BancosContratistas */

$this->title = 'Update Bancos Contratistas: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bancos Contratistas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bancos-contratistas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

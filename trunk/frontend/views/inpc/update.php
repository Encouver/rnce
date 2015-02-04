<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Inpc */

$this->title = 'Update Inpc: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inpcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inpc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

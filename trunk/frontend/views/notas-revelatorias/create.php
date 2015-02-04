<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\NotasRevelatorias */

$this->title = 'Create Notas Revelatorias';
$this->params['breadcrumbs'][] = ['label' => 'Notas Revelatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-revelatorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

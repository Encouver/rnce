<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RepsLegales */

$this->title = 'Create Reps Legales';
$this->params['breadcrumbs'][] = ['label' => 'Reps Legales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reps-legales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

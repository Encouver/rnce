<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SustentoConts */

$this->title = 'Create Sustento Conts';
$this->params['breadcrumbs'][] = ['label' => 'Sustento Conts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sustento-conts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

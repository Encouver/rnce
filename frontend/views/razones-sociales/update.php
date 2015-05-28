<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\RazonesSociales */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Razones Sociales',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Razones Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="razones-sociales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

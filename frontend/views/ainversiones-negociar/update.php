<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\c\AInversionesNegociar */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Ainversiones Negociar',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ainversiones Negociars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ainversiones-negociar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

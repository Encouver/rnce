<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosMejorasPropiedades */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Activos Mejoras Propiedades',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Mejoras Propiedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="activos-mejoras-propiedades-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

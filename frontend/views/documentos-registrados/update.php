<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\a\DocumentosRegistrados */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Documentos Registrados',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos Registrados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="documentos-registrados-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\Direcciones */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Direcciones',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Direcciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="direcciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

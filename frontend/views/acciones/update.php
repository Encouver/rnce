<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\Acciones */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Acciones',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="acciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

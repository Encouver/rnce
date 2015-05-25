<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\Sucursales */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Sucursales',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sucursales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sucursales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'direccion'=>$direccion
    ]) ?>

</div>

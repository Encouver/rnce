<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Objetos Autorizaciones',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Autorizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="objetos-autorizaciones-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

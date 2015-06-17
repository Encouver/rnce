<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\PolizasContratadas */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Polizas Contratadas',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polizas Contratadas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="polizas-contratadas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

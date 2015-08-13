<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\DuracionesEmpresas */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Duración empresa',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Duración empresa'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="duraciones-empresas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

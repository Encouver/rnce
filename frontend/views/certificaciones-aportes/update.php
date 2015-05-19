<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\CertificacionesAportes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Certificaciones Aportes',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificaciones Aportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="certificaciones-aportes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

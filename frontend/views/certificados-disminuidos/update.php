<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\CertificadosDisminuidos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Certificados Disminuidos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificados Disminuidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="certificados-disminuidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

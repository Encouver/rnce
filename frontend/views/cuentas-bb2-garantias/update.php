<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb2Garantias */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cuentas Bb2 Garantias',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Bb2 Garantias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cuentas-bb2-garantias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

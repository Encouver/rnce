<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDesincorporacionActivos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Activos Desincorporacion Activos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Desincorporacion Activos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="activos-desincorporacion-activos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\ContratistasContactos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Contratistas Contactos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="contratistas-contactos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

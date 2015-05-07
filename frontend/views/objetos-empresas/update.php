<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosEmpresas */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Objetos Empresas',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="objetos-empresas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

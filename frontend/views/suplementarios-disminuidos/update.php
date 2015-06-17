<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\SuplementariosDisminuidos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Suplementarios Disminuidos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suplementarios Disminuidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="suplementarios-disminuidos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

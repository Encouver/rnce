<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\RelacionesContratos */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Relaciones Contratos',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Contratos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="relaciones-contratos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

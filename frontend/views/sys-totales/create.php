<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\SysTotales */

$this->title = Yii::t('app', 'Create Sys Totales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Totales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-totales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

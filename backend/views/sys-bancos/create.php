<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\SysBancos */

$this->title = Yii::t('app', 'Create Sys Bancos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Bancos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-bancos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

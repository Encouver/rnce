<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\SysPaises */

$this->title = Yii::t('app', 'Create Sys Paises');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Paises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-paises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

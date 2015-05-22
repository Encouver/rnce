<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\SysNaturalesJuridicas */

$this->title = Yii::t('app', 'Create Sys Naturales Juridicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Naturales Juridicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-naturales-juridicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

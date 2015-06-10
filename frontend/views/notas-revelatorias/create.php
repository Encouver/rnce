<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\NotasRevelatorias */

$this->title = Yii::t('app', 'Create Notas Revelatorias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notas Revelatorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notas-revelatorias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

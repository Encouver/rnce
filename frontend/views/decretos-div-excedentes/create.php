<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\DecretosDivExcedentes */

$this->title = Yii::t('app', 'Create Decretos Div Excedentes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decretos Div Excedentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decretos-div-excedentes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

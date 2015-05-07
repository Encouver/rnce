<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\AaObligacionesBancarias */

$this->title = Yii::t('app', 'Create Aa Obligaciones Bancarias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aa Obligaciones Bancarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aa-obligaciones-bancarias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

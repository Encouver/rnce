<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\CierresEjercicios */

$this->title = Yii::t('app', 'Create Cierres Ejercicios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cierres Ejercicios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cierres-ejercicios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

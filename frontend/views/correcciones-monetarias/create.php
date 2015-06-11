<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\CorreccionesMonetarias */

$this->title = Yii::t('app', 'Create Correcciones Monetarias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Correcciones Monetarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correcciones-monetarias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

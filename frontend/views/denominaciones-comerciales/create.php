<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\DenominacionesComerciales */

$this->title = Yii::t('app', 'Create Denominaciones Comerciales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Denominaciones Comerciales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="denominaciones-comerciales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

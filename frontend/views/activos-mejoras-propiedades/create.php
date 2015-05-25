<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosMejorasPropiedades */

$this->title = Yii::t('app', 'Create Activos Mejoras Propiedades');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Mejoras Propiedades'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-mejoras-propiedades-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

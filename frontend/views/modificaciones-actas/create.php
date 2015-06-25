<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ModificacionesActas */

$this->title = Yii::t('app', 'Create Modificaciones Actas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modificaciones Actas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificaciones-actas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'=>$model,
        'acciones'=>$acciones
    ]) ?>

</div>

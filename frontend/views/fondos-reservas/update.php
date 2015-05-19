<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\FondosReservas */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Fondos Reservas',
]) . ' ' . $fondo_reserva->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondos Reservas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $fondo_reserva->id, 'url' => ['view', 'id' => $fondo_reserva->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="fondos-reservas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'fondo_reserva' => $fondo_reserva,
    ]) ?>

</div>

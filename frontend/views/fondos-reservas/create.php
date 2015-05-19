<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\FondosReservas */

$this->title = Yii::t('app', 'Create Fondos Reservas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondos Reservas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondos-reservas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'fondo_reserva' => $fondo_reserva,
    ]) ?>

</div>

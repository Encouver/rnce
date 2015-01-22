<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfectivoCaja */

$this->title = 'Create Efectivo Caja';
$this->params['breadcrumbs'][] = ['label' => 'Efectivo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="efectivo-caja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

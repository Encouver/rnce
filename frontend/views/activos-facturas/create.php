<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosFacturas */

$this->title = Yii::t('app', 'Cargar Facturas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Facturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-facturas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

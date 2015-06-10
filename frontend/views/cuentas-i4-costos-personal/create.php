<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI4CostosPersonal */

$this->title = Yii::t('app', 'Create Cuentas I4 Costos Personal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas I4 Costos Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-i4-costos-personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

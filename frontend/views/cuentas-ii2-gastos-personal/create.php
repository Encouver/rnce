<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi2GastosPersonal */

$this->title = Yii::t('app', 'Create Cuentas Ii2 Gastos Personal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ii2 Gastos Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ii2-gastos-personal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

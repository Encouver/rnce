<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasHhPasivoLaboral */

$this->title = Yii::t('app', 'Create Cuentas Hh Pasivo Laboral');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Hh Pasivo Laborals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-hh-pasivo-laboral-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

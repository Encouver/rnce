<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasSysFormulasTecnicas */

$this->title = Yii::t('app', 'Create Cuentas Sys Formulas Tecnicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Sys Formulas Tecnicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-sys-formulas-tecnicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

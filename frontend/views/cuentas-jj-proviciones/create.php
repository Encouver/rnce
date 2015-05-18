<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasJjProviciones */

$this->title = Yii::t('app', 'Create Cuentas Jj Proviciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Jj Proviciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-jj-proviciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarSprivpub */

$this->title = 'Create Cuentas Cobrar Sprivpub';
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Sprivpubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-sprivpub-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

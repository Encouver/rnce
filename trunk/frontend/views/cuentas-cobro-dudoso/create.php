<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobroDudoso */

$this->title = 'Create Cuentas Cobro Dudoso';
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobro Dudosos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobro-dudoso-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

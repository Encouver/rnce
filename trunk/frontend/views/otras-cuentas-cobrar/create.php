<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\OtrasCuentasCobrar */

$this->title = 'Create Otras Cuentas Cobrar';
$this->params['breadcrumbs'][] = ['label' => 'Otras Cuentas Cobrars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="otras-cuentas-cobrar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

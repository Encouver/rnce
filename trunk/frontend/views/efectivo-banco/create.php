<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\EfectivoBanco */

$this->title = 'Create Efectivo Banco';
$this->params['breadcrumbs'][] = ['label' => 'Efectivo Bancos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="efectivo-banco-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

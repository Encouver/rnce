<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposDeudores */

$this->title = 'Create Tipos Deudores';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Deudores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-deudores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

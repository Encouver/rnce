<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\VariablesGlobales */

$this->title = 'Create Variables Globales';
$this->params['breadcrumbs'][] = ['label' => 'Variables Globales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="variables-globales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposSustentos */

$this->title = 'Create Tipos Sustentos';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Sustentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-sustentos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

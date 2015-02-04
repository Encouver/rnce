<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InventariosC */

$this->title = 'Create Inventarios C';
$this->params['breadcrumbs'][] = ['label' => 'Inventarios Cs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventarios-c-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

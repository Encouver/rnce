<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Inpc */

$this->title = 'Create Inpc';
$this->params['breadcrumbs'][] = ['label' => 'Inpcs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposInversiones */

$this->title = 'Create Tipos Inversiones';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Inversiones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-inversiones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

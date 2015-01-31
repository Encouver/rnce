<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TiposCajas */

$this->title = 'Create Tipos Cajas';
$this->params['breadcrumbs'][] = ['label' => 'Tipos Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipos-cajas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

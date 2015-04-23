<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\NombresCajas */

$this->title = Yii::t('app', 'Create Nombres Cajas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nombres Cajas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="nombres-cajas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

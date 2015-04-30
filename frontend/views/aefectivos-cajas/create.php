<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosCajas */

$this->title = Yii::t('app', 'Create Aefectivos Cajas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aefectivos Cajas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aefectivos-cajas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\AInversionesNegociar */

$this->title = Yii::t('app', 'Create Ainversiones Negociar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ainversiones Negociars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ainversiones-negociar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

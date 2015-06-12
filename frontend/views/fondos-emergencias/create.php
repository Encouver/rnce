<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\FondosEmergencias */

$this->title = Yii::t('app', 'Create Fondos Emergencias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Fondos Emergencias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fondos-emergencias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

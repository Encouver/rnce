<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */

$this->title = Yii::t('app', 'Create Persona Natural');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Persona Natural'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-naturales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

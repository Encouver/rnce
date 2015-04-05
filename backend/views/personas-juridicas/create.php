<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PersonasJuridicas */

$this->title = Yii::t('app', 'Create Personas Juridicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Personas Juridicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personas-juridicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

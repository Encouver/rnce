<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDeterioros */

$this->title = Yii::t('app', 'Create Activos Deterioros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Deterioros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-deterioros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

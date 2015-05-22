<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosAvaluos */

$this->title = Yii::t('app', 'Carga de Avaluos Bienes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Avaluos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-avaluos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\ActivosSysMetodosMedicion */

$this->title = Yii::t('app', 'Create Activos Sys Metodos Medicion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Sys Metodos Medicions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-sys-metodos-medicion-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

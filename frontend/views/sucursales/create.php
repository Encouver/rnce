<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Sucursales */

$this->title = Yii::t('app', 'Create Sucursales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sucursales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sucursales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'direccion'=>$direccion
    ]) ?>

</div>

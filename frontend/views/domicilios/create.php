<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Domicilios */

$this->title = Yii::t('app', 'Crear Direccion');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Direccion'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model'=>$model,
        'direccion' => $direccion,
    ]) ?>

</div>

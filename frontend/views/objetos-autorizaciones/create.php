<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */

$this->title = Yii::t('app', 'Create Objetos Autorizaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Autorizaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-autorizaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

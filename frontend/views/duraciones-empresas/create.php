<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\DuracionesEmpresas */

$this->title = Yii::t('app', 'Create Duración empresa');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Duración empresa'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duraciones-empresas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

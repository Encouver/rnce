<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\DuracionesEmpresas */

$this->title = Yii::t('app', 'Create Duraciones Empresas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Duraciones Empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duraciones-empresas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

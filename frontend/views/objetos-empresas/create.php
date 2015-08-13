<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosEmpresas */

$this->title = Yii::t('app', 'Objetos empresas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos empresas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-empresas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

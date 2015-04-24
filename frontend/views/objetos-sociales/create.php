<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */

$this->title = Yii::t('app', 'Create Objetos Sociales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Objetos Sociales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="objetos-sociales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

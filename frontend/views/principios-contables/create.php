<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\PrincipiosContables */

$this->title = Yii::t('app', 'Agregar Principio Contable');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Principios Contables'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="principios-contables-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

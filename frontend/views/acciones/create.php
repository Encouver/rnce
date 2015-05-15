<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Acciones */

$this->title = Yii::t('app', 'Create Acciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

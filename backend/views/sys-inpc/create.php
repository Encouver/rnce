<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\SysInpc */

$this->title = Yii::t('app', 'Create Sys Inpc');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sys Inpcs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-inpc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

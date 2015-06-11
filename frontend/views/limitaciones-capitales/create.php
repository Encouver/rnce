<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\LimitacionesCapitales */

$this->title = Yii::t('app', 'Create Limitaciones Capitales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-capitales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ActividadesEconomicas */

$this->title = Yii::t('app', 'Create Actividades Economicas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actividades Economicas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actividades-economicas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

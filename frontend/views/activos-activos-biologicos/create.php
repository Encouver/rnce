<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosActivosBiologicos */

$this->title = Yii::t('app', 'Create Activos Activos Biologicos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Activos Biologicos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-activos-biologicos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosInmuebles */

$this->title = Yii::t('app', 'Create Activos Inmuebles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Inmuebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-inmuebles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

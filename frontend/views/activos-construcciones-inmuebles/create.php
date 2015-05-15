<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosConstruccionesInmuebles */

$this->title = Yii::t('app', 'Create Activos Construcciones Inmuebles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Construcciones Inmuebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-construcciones-inmuebles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

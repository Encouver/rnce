<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosFabricacionesMuebles */

$this->title = Yii::t('app', 'Create Activos Fabricaciones Muebles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Fabricaciones Muebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-fabricaciones-muebles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

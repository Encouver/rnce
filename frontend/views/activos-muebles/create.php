<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosMuebles */

$this->title = Yii::t('app', 'Create Activos Muebles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Muebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-muebles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

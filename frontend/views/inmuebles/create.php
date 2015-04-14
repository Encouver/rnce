<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Inmuebles */

$this->title = Yii::t('app', 'Create Inmuebles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inmuebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmuebles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

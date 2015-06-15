<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\AccionesDisminuidas */

$this->title = Yii::t('app', 'Create Acciones Disminuidas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Acciones Disminuidas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="acciones-disminuidas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

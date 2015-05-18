<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Suplementarios */

$this->title = Yii::t('app', 'Create Suplementarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suplementarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suplementarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

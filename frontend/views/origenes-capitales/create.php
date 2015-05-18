<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */

$this->title = Yii::t('app', 'Create Origenes Capitales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Origenes Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origenes-capitales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

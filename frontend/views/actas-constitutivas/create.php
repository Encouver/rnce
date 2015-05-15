<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ActasConstitutivas */

$this->title = Yii::t('app', 'Create Actas Constitutivas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Actas Constitutivas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="actas-constitutivas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

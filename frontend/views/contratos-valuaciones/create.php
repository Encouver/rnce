<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ContratosValuaciones */

$this->title = Yii::t('app', 'Create Contratos Valuaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratos Valuaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratos-valuaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\PolizasContratadas */

$this->title = Yii::t('app', 'Create Polizas Contratadas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polizas Contratadas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polizas-contratadas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\RelacionesContratos */

$this->title = Yii::t('app', 'Agregar Relaciones Contratos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Relaciones Contratos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relaciones-contratos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

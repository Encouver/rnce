<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\PagosAccionistasDecretos */

$this->title = Yii::t('app', 'Create Pagos Accionistas Decretos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pagos Accionistas Decretos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagos-accionistas-decretos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

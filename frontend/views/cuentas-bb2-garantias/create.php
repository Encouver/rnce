<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb2Garantias */

$this->title = Yii::t('app', 'Create Cuentas Bb2 Garantias');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Bb2 Garantias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb2-garantias-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

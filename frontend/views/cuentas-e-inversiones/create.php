<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasEInversiones */

$this->title = Yii::t('app', 'Create Cuentas Einversiones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Einversiones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-einversiones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

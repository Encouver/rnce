<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasCTiposInventarios */

$this->title = Yii::t('app', 'Create Cuentas Ctipos Inventarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ctipos Inventarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ctipos-inventarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasDd3OtrosTributos */

$this->title = Yii::t('app', 'Create Cuentas Dd3 Otros Tributos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Dd3 Otros Tributos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-dd3-otros-tributos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

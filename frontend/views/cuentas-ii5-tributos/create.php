<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi5Tributos */

$this->title = Yii::t('app', 'Create Cuentas Ii5 Tributos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ii5 Tributos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ii5-tributos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

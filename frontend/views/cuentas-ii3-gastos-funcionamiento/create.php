<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi3GastosFuncionamiento */

$this->title = Yii::t('app', 'Create Cuentas Ii3 Gastos Funcionamiento');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ii3 Gastos Funcionamientos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ii3-gastos-funcionamiento-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI2DeclaracionIva */

$this->title = Yii::t('app', 'Create Cuentas I2 Declaracion Iva');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas I2 Declaracion Ivas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-i2-declaracion-iva-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'dataProvider'=>$dataProvider,
    ]) ?>

</div>

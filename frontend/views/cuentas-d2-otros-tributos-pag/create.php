<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasD2OtrosTributosPag */

$this->title = Yii::t('app', 'Create Cuentas D2 Otros Tributos Pag');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas D2 Otros Tributos Pags'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-d2-otros-tributos-pag-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelBeneficiarios'=>$modelBeneficiarios,
    ]) ?>

</div>

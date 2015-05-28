<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasD1IslrPagadoAnticipo */

$this->title = Yii::t('app', 'Create Cuentas D1 Islr Pagado Anticipo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas D1 Islr Pagado Anticipos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-d1-islr-pagado-anticipo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelBeneficiarios'=>$modelBeneficiarios
    ]) ?>

</div>

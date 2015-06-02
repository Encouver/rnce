<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ContratosFacturas */

$this->title = Yii::t('app', 'Create Contratos Facturas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratos Facturas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratos-facturas-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

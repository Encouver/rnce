<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasCInventarios */

$this->title = Yii::t('app', 'Create Cuentas Cinventarios');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Cinventarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cinventarios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

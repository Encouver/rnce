<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\CertificacionesAportes */

$this->title = Yii::t('app', 'Create Certificaciones Aportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificaciones Aportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificaciones-aportes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'certificacion_aporte' => $certificacion_aporte,
    ]) ?>

</div>

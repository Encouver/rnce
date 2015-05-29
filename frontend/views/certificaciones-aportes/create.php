<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\CertificacionesAportes */

$this->title = Yii::t('app', 'Create Certificaciones Aportes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificaciones Aportes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificaciones-aportes-create">

   

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona'=>$modelPersona
    ]) ?>

</div>

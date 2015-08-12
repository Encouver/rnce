<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ComisariosAuditores */

$this->title = Yii::t('app', 'Aegregar Comisario Auditor');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comisarios Auditores'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comisarios-auditores-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona'=>$modelPersona,
    ]) ?>

</div>

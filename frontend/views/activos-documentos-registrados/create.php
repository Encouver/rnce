<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDocumentosRegistrados */

$this->title = Yii::t('app', 'Create Activos Documentos Registrados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Documentos Registrados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-documentos-registrados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

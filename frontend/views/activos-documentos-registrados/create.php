<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDocumentosRegistrados */

$this->title = Yii::t('app', 'Cargar Documentos Registrados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos Registrados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-documentos-registrados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'url'=>$url
    ]) ?>

</div>

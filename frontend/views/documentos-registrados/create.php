<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\DocumentosRegistrados */

$this->title = Yii::t('app', 'Create Documentos Registrados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documentos Registrados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="documentos-registrados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

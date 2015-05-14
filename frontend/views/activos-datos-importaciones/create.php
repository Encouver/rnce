<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDatosImportaciones */

$this->title = Yii::t('app', 'Create Activos Datos Importaciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Datos Importaciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-datos-importaciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

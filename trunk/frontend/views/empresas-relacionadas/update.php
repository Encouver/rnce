<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EmpresasRelacionadas */

$this->title = 'Update Empresas Relacionadas: ' . ' ' . $model->empresa_id;
$this->params['breadcrumbs'][] = ['label' => 'Empresas Relacionadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->empresa_id, 'url' => ['view', 'empresa_id' => $model->empresa_id, 'contratista_id' => $model->contratista_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="empresas-relacionadas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\EmpresasRelacionadas */

$this->title = Yii::t('app', 'Create Empresas Relacionadas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Empresas Relacionadas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-relacionadas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona'=>$modelPersona,
        'modelJuridica'=>$modelJuridica,
        'modelDocumento'=>$modelDocumento,
    ]) ?>

</div>

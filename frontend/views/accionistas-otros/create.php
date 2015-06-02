<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */

$this->title = Yii::t('app', 'Create Accionistas Otros');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Accionistas Otros'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accionistas-otros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelPersona'=>$modelPersona,
        'modelJuridica'=>$modelJuridica,
    ]) ?>

</div>

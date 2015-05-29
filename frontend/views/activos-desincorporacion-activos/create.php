<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDesincorporacionActivos */

$this->title = Yii::t('app', 'Create Activos Desincorporacion Activos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Desincorporacion Activos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-desincorporacion-activos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelBien'=>$modelBien
    ]) ?>

</div>

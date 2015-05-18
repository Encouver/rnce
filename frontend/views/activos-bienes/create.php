<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosBienes */

$this->title = Yii::t('app', 'Create Activos Bienes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Activos Bienes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activos-bienes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model, 'modelBienTipo'=>$modelBienTipo, 'modelDatosImportacion'=>$modelDatosImportacion, 'modelFactura'=>$modelFactura,'modelDocumento'=>$modelDocumento
    ]) ?>

</div>

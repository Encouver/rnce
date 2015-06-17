<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\CertificadosDisminuidos */

$this->title = Yii::t('app', 'Create Certificados Disminuidos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificados Disminuidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-disminuidos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

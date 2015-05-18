<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\Certificados */

$this->title = Yii::t('app', 'Create Certificados');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Certificados'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="certificados-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

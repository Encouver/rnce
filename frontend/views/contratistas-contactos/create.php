<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\ContratistasContactos */

$this->title = Yii::t('app', 'Create Contratistas Contactos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contratistas Contactos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contratistas-contactos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

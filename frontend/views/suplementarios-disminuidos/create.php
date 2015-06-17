<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\SuplementariosDisminuidos */

$this->title = Yii::t('app', 'Create Suplementarios Disminuidos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Suplementarios Disminuidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="suplementarios-disminuidos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\p\AportesCapitalizar */

$this->title = Yii::t('app', 'Create Aportes Capitalizar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Aportes Capitalizars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aportes-capitalizar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

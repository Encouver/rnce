<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresasRelacionadasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Empresas Relacionadas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-relacionadas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Empresas Relacionadas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'empresa_id',
            'contratista_id',
            'otras_cuentas_pagar_id',
            'participacion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

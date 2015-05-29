<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccionistasOtrosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accionistas Otros');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accionistas-otros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre Accionista',
                'value'=>'naturalJuridica.denominacion'
            ],
            'accionista:boolean',
            'porcentaje_accionario',
            'junta_directiva:boolean',
            'tipo_cargo',
            'rep_legal:boolean',
            'repr_legal_vigencia',
            'tipo_obligacion',
            
            //'contratista_id',
           // 'natural_juridica_id',
            //'valor_compra',
            // 'fecha',
            // 'accionista:boolean',
            // 'junta_directiva:boolean',
            // 'rep_legal:boolean',
            // 'documento_registrado_id',
            // 'repr_legal_vigencia',
            // 'empresa_fusionada_id',
            // 'tipo_obligacion',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'empresa_relacionada:boolean',
            // 'tipo_cargo',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
     <p>
        <?= Html::a(Yii::t('app', 'Create Accionistas Otros'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>

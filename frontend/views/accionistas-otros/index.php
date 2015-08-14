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

    <h1>Accionistas</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProviderAccionista,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
            'porcentaje_accionario',
            [
                'attribute'=>'junta_directiva',
                'value'=>function ($model) {
                    if($model->tipo_cargo!=null){
                        return 'Si';
                    }else{
                        return 'No';
                    }
        
                }
            ],
            'tipo_cargo',
            [
                'attribute'=>'rep_legal',
                'value'=>function ($model) {
                    if($model->repr_legal_vigencia!=null){
                        return 'Si';
                    }else{
                        return 'No';
                    }
        
                }
            ],
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
        <?= Html::a(Yii::t('app', 'Agregar Accionista'), ['create','id'=>'accionista'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>Representante Legal</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProviderRepresentante,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
     
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
        <?= Html::a(Yii::t('app', 'Agregar Representante'), ['create','id'=>'representante'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1>Junta Directiva</h1>
    <?= GridView::widget([
        'dataProvider' => $dataProviderJunta,
        //'filterModel' => $searchModel,
        'summary'=>"",
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'natural_juridica_id',
                'label'=>'Nombre',
                'value'=>'naturalJuridica.denominacion'
            ],
            'tipo_cargo',
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
        <?= Html::a(Yii::t('app', 'Agregar Directiva'), ['create','id'=>'junta'], ['class' => 'btn btn-success']) ?>
    </p>



</div>

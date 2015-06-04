<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmpresasRelacionadasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Empresas Relacionadas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="empresas-relacionadas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'tipo_relacion',
            
            [
                'attribute'=>'persona_juridica_id',
                'label'=>'Empresa Relacionada',
                'value'=>'personaJuridica.denominacion'
            ],
            'objeto_empresa',
             [
                'attribute'=>'persona_contacto_id',
                'label'=>'Persona de contacto',
                'value'=>'personaContacto.denominacion'
            ],
             [
                'attribute'=>'documento_registrado_id',
                'label'=>'Numero documento',
                'value'=>'documentoRegistrado.numero_registro'
            ],
            'fecha_inicio',
            'fecha_fin',
            // 'persona_juridica_id',
            // 'persona_contacto_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'contratista_id',
            // 'documento_registrado_id',

            ['class' => 'yii\grid\ActionColumn','template'=>'{update}{delete}'],
        ],
    ]); ?>
     <p>
        <?= Html::a(Yii::t('app', 'Crear empresa relacionada'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>


</div>

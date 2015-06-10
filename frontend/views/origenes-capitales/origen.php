<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrigenesCapitalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Origenes Capitales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origenes-capitales-index">

      <h3>Efectivo</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_efectivo,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'tipo_origen',
            //'bien_id',
            //'banco_contratista_id',
            'monto',
            'fecha',
            // 'saldo_cierre_anterior',
            // 'saldo_corte',
            // 'fecha_corte',
            // 'monto_aumento',
            // 'saldo_aumento',
            // 'numero_accion',
            // 'valor_acciones',
            // 'saldo_cierre_ajustado',
            // 'fecha_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
       <?php 
    if(!$searchModel->existeregistro()){ ?>
       <p>
        <?= Html::a(Yii::t('app', 'Agregar Efectivo'), ['create', 'identificador' => 'efectivo'], ['class' => 'btn btn-success']) ?>
       </p>
    <?php } ?>
     
    <hr />
    <h3>Efectivo en banco</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_banco,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                'attribute' => 'banco_contratista_id',
                'label' => 'banco',
                'value' => 'bancoContratista.banco.nombre',
            ],
            [
                'attribute' => 'banco_contratista_id',
                'label' => 'Numero de cuenta',
                'value' => 'bancoContratista.num_cuenta',
            ],
            //'id',
            //'tipo_origen',
            //'bien_id',
            'numero_transaccion',
            //'banco_contratista_id',
            'monto',
            'fecha',
            // 'saldo_cierre_anterior',
            // 'saldo_corte',
            // 'fecha_corte',
            // 'monto_aumento',
            // 'saldo_aumento',
            // 'numero_accion',
            // 'valor_acciones',
            // 'saldo_cierre_ajustado',
            // 'fecha_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$searchModel->existeregistro()){ ?>
        <p>
        <?= Html::a(Yii::t('app', 'Agregar Efectivo Banco'),['create', 'identificador' => 'banco'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
   
    <hr />
    <h3>Bienes</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_bien,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                'attribute' => 'bien_id',
                'label' => 'Tipo Bien',
                'value' => 'bien0.sysTipoBien.nombre',
            ],
            [
                'attribute' => 'bien_id',
                'label' => 'Detalle Bien',
                'value' => 'bien0.detalle',
            ],
            [
                'attribute' => 'bien_id',
                'label' => 'Fecha Origen',
                'value' => 'bien0.fecha_origen',
            ],
            //'id',
            //'tipo_origen',
            //'bien_id',
            //'numero_transaccion',
            //'banco_contratista_id',
            'monto',
            //'fecha',
            // 'saldo_cierre_anterior',
            // 'saldo_corte',
            // 'fecha_corte',
            // 'monto_aumento',
            // 'saldo_aumento',
            // 'numero_accion',
            // 'valor_acciones',
            // 'saldo_cierre_ajustado',
            // 'fecha_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$searchModel->existeregistro()){ ?>
     <p>
        <?= Html::a(Yii::t('app', 'Agregar Bien'), ['create', 'identificador' => 'bien'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    <hr />
    <h3>Cuenta por pagar</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_cuentapagar,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            'tipo_origen',
            //'bien_id',
            //'numero_transaccion',
            //'banco_contratista_id',
            //'monto',
            //'fecha',
            'saldo_cierre_anterior',
            'saldo_corte',
            'fecha_corte',
            'monto_aumento',
            'saldo_aumento',
            // 'numero_accion',
            // 'valor_acciones',
            // 'saldo_cierre_ajustado',
            // 'fecha_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$searchModel->existeregistro()){ ?>
     <p>
        <?= Html::a(Yii::t('app', 'Agregar Pago accionista'), ['create', 'identificador' => 'cuentapagar'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
    <hr />
    <h3>Decreto de diviendo en acciones</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider_decreto,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            //'id',
            'tipo_origen',
       
          
            'numero_accion',
            'valor_acciones',
            'saldo_cierre_ajustado',
            'fecha_aumento',
             'monto_aumento',
            // 'contratista_id',
            // 'documento_registrado_id',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn', 'template'=>'{update}{delete}'],
        ],
    ]); ?>
     <?php 
    if(!$searchModel->existeregistro()){ ?>
     <p>
        <?= Html::a(Yii::t('app', 'Agregar Decreto dividiendo en acciones'), ['create', 'identificador' => 'decreto'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>
    
</div>

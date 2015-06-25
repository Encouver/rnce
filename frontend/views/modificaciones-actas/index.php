<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ModificacionesActasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modificaciones Actas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificaciones-actas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if(isset($model)){?>
     <table class="table table-striped table-bordered">
         <thead>
            <tr>
                <?php if($model->pago_capital){?><th>Pago Capital</th> <?php } ?>
                <?php if($model->aumento_capital){?><th>Aumento Capital</th> <?php } ?>
                <?php if($model->aporte_capitalizar){?><th>Aporte Capitalizar</th> <?php } ?>
                <?php if($model->coreccion_monetaria){?><th>Correccion Monetaria</th> <?php } ?>
                <?php if($model->disminucion_capital){?><th>Disminucion Capital</th> <?php } ?>
                <?php if($model->limitacion_capital){?><th>Limitacion Capital</th> <?php } ?>
                <?php if($model->limitacion_capital_afectado){?><th>Limitacion Capital Afectado</th> <?php } ?>
                <?php if($model->fondo_emergencia){?><th>Fondo Emergencia</th> <?php } ?>
                <?php if($model->reintegro_perdida){?><th>Reintegro Perdida</th> <?php } ?>
                <?php if($model->venta_accion){?><th>Venta Accion</th> <?php } ?>
                <?php if($model->fusion_empresarial){?><th>Fusion Empresarial</th> <?php } ?>
                <?php if($model->decreto_div_excedente){?><th>Decreto Dividiendo en Acciones</th> <?php } ?>
                <?php if($model->modificacion_balance){?><th>Modificacion Balance</th> <?php } ?>
                <?php if($model->razon_social){?><th>Razon Social</th> <?php } ?>
                <?php if($model->denominacion_comercial){?><th>Denominacion Comercial</th> <?php } ?>
                <?php if($model->objeto_social){?><th>Objeto Social</th> <?php } ?>
                <?php if($model->duracion_empresa){?><th>Duracion Empresa</th> <?php } ?>
                <?php if($model->cierre_ejercicio){?><th>Cierre Ejercicio</th> <?php } ?>
                <?php if($model->domicilio_fiscal){?><th>Domicilio</th> <?php } ?>
                <?php if($model->representante_legal){?><th>Representante Legal</th> <?php } ?>
                <?php if($model->junta_directiva){?><th>Junta Directiva</th> <?php } ?>
                <?php if($model->comisario){?><th>Comisario</th> <?php } ?>
                
            <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <?php if($model->pago_capital){?><td>Sí</td> <?php } ?>
                <?php if($model->aumento_capital){?><td>Sí</td> <?php } ?>
                <?php if($model->aporte_capitalizar){?><td>Sí</td> <?php } ?>
                <?php if($model->coreccion_monetaria){?><td>Sí</td><?php } ?>
                <?php if($model->disminucion_capital){?><td>Sí</td><?php } ?>
                <?php if($model->limitacion_capital){?><td>Sí</td><?php } ?>
                <?php if($model->limitacion_capital_afectado){?><td>Sí</td><?php } ?>
                <?php if($model->fondo_emergencia){?><td>Sí</td> <?php } ?>
                <?php if($model->reintegro_perdida){?><td>Sí</td><?php } ?>
                <?php if($model->venta_accion){?><td>Sí</td> <?php } ?>
                <?php if($model->fusion_empresarial){?><td>Sí</td> <?php } ?>
                <?php if($model->decreto_div_excedente){?><td>Sí</td><?php } ?>
                <?php if($model->modificacion_balance){?><td>Sí</td> <?php } ?>
                <?php if($model->razon_social){?><td>Sí</td><?php } ?>
                <?php if($model->denominacion_comercial){?><td>Sí</td><?php } ?>
                <?php if($model->objeto_social){?><td>Sí</td> <?php } ?>
                <?php if($model->duracion_empresa){?><td>Sí</td><?php } ?>
                <?php if($model->cierre_ejercicio){?><td>Sí</td> <?php } ?>
                <?php if($model->domicilio_fiscal){?><td>Sí</td><?php } ?>
                <?php if($model->representante_legal){?><td>Sí</td> <?php } ?>
                <?php if($model->junta_directiva){?><td>Sí</td><?php } ?>
                <?php if($model->comisario){?><td>Sí</td><?php } ?>
                <td>
                     <?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                    'class' =>'profile-link',
                    'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                    ],
                ]) ?></td>
            </tr>
        </tbody>
        
        
    </table>
    <?php } ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Modificaciones Actas'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    

</div>

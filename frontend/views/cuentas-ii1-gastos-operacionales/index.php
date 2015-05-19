<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuentasIi1GastosOperacionalesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuentas Ii1 Gastos Operacionales');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ii1-gastos-operacionales-index">
<br><br>
    <h1><?= Html::encode($this->title) ?></h1>
<br><br>
    <table class="table table-bordered">
            <!--<caption>Total efectivo y sus equivalentes</caption>-->
            <thead>
              <tr>
                <th>
                    &nbsp;
                    &nbsp;
                </th>
                <th>
                    Ventas (Historico)
                </th>
                <th>
                    Ventas (Ajustado por inflación)
                </th>
                <th>
                    Administracion (Historico)
                </th>
                <th>
                    Administracion (Ajustado por inflación)
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Gastos de personal</td><td>0</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              </tr>
              <tr>
                <td>Gastos de funcionamiento</td><td>0</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              </tr>
              <tr>
                <td>Depreciación y amortización</td><td>0</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              </tr>
              <tr>
                <td>Tributos</td><td>0</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              </tr>
              <tr>
                <td><strong>Total gastos operacionales</strong></td><td>0</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
              </tr>
            </tbody>
        </table>

<!--
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cuentas Ii1 Gastos Operacionales'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tipo_gasto',
            'ventas_hist',
            'ventas_ajustado',
            'admin_hist',
            // 'admin_ajustado',
            // 'contratista_id',
            // 'anho',
            // 'creado_por',
            // 'actualizado_por',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
-->
</div>

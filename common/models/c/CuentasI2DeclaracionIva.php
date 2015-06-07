<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.i2_declaracion_iva".
 *
 * @property integer $id
 * @property integer $periodo_id
 * @property integer $certificado_electronico
 * @property string $ventas_grabadas
 * @property string $ventas_no_grabadas
 * @property string $ingresos_totales
 * @property string $debito_fiscal
 * @property string $compras_gravadas
 * @property string $compras_no_gravadas
 * @property string $egresos_totales_compra
 * @property string $credito_fiscal
 * @property string $imp_pagar_compensar
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property string $anho
 *
 * @property CuentasSysPeriodos $periodo
 * @property Contratistas $contratista
 */
class CuentasI2DeclaracionIva extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.i2_declaracion_iva';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['periodo_id', 'certificado_electronico', 'ventas_grabadas', 'ventas_no_grabadas', 'debito_fiscal', 'compras_gravadas', 'egresos_totales_compra', 'credito_fiscal', 'imp_pagar_compensar', 'contratista_id', 'anho'], 'required'],
            [['ventas_grabadas', 'ventas_no_grabadas', 'debito_fiscal', 'compras_gravadas', 'egresos_totales_compra', 'credito_fiscal', 'imp_pagar_compensar',], 'default', 'value'=>0],
            [['periodo_id', 'certificado_electronico', 'creado_por', 'actualizado_por', 'contratista_id'], 'integer'],
            [['ventas_grabadas', 'ventas_no_grabadas', 'ingresos_totales', 'debito_fiscal', 'compras_gravadas', 'compras_no_gravadas', 'egresos_totales_compra', 'credito_fiscal', 'imp_pagar_compensar'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['periodo_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['periodo_id', 'contratista_id', 'anho'], 'message' => 'The combination of Periodo ID, Contratista ID and Anho has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'periodo_id' => Yii::t('app', 'Mes'),
            'certificado_electronico' => Yii::t('app', 'Certificado Electrónico Número'),
            'ventas_grabadas' => Yii::t('app', 'Ventas Grabadas'),
            'ventas_no_grabadas' => Yii::t('app', 'Ventas No Grabadas'),
            'ingresos_totales' => Yii::t('app', 'Ingresos Totales'),
            'debito_fiscal' => Yii::t('app', 'Debito Fiscal'),
            'compras_gravadas' => Yii::t('app', 'Compras Gravadas'),
            'compras_no_gravadas' => Yii::t('app', 'Compras No Gravadas'),
            'egresos_totales_compra' => Yii::t('app', 'Egresos Totales Compra'),
            'credito_fiscal' => Yii::t('app', 'Credito Fiscal'),
            'imp_pagar_compensar' => Yii::t('app', 'Imp Pagar Compensar'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPeriodo()
    {
        return $this->hasOne(CuentasSysPeriodos::className(), ['id' => 'periodo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    public function Inicializar(){

        if(!CuentasI2DeclaracionIva::find()->where(['contratista_id'=>Yii::$app->user->identity->contratista_id,'anho'=>date('m-Y')])->all()) {

            $transaction = \Yii::$app->db->beginTransaction();
            try {
                foreach (CuentasSysPeriodos::porDescripcion('mes') as $key => $periodo) {
                        $model = new CuentasI2DeclaracionIva();
                        $model->periodo_id = $periodo->id;
                        $model->certificado_electronico = 0;
                        $model->ventas_grabadas = 0;
                        $model->ventas_no_grabadas = 0;
                        $model->debito_fiscal = 0;
                        $model->compras_gravadas = 0;
                        $model->compras_no_gravadas = 0;
                        $model->egresos_totales_compra = 0;
                        $model->credito_fiscal = 0;
                        $model->imp_pagar_compensar = 0;


                        if(!($flag = $model->save())) {
                            print_r($model->getErrors());die;
                            break;
                        }
                }

                if($flag)
                    $transaction->commit();
                else
                    $transaction->rollBack();

            } catch (Exception $e) {
                $transaction->rollBack();
            }
        }
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],

            'periodo_id' => ['type'=>Form::INPUT_RAW, 'value'=>'periodo.nombre'],/*['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasSysPeriodos::porDescripcion('mes'),'id','nombre'),
                'options'=>['id'=>'iva-periodo_'.uniqid(),'placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],*/
            'certificado_electronico' => ['type'=>Form::INPUT_TEXT,],
            'ventas_grabadas' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'ventas_no_grabadas' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'ingresos_totales' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'debito_fiscal' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'compras_gravadas' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'compras_no_gravadas' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'egresos_totales_compra' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'credito_fiscal' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'imp_pagar_compensar' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],

        ];
    }

    public function getFormAttribsStatic() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],

            'periodo_id' => ['type'=>Form::INPUT_RAW, 'value'=>'periodo.nombre'],
            'certificado_electronico' => ['type'=>Form::INPUT_STATIC,],
            'ventas_grabadas' => ['type'=>Form::INPUT_STATIC],
            'ventas_no_grabadas' => ['type'=>Form::INPUT_STATIC],
            'ingresos_totales' => ['type'=>Form::INPUT_STATIC],
            'debito_fiscal' => ['type'=>Form::INPUT_STATIC],
            'compras_gravadas' => ['type'=>Form::INPUT_STATIC],
            'compras_no_gravadas' => ['type'=>Form::INPUT_STATIC],
            'egresos_totales_compra' => ['type'=>Form::INPUT_STATIC],
            'credito_fiscal' => ['type'=>Form::INPUT_STATIC],
            'imp_pagar_compensar' => ['type'=>Form::INPUT_STATIC],

        ];
    }

    public function Calculo(){

        //$this->saldo_cierre = $this->saldo_ph + $this->importe_pagado_ejer_econo + $this->monto + $this->importe_aplicado_ejer_econo;

        return true;
    }
}

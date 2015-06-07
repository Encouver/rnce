<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.i2_declaracion_islr".
 *
 * @property integer $id
 * @property integer $tipo_declaracion_id
 * @property integer $numero_planilla
 * @property string $num_certificado_elec
 * @property string $fecha
 * @property string $total_ingresos
 * @property string $total_egresos
 * @property string $impuesto_determinado
 * @property string $impuesto_pagado
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $contratista_id
 * @property string $anho
 *
 * @property CuentasSysTotales $tipoDeclaracion
 * @property Contratistas $contratista
 */
class CuentasI2DeclaracionIslr extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.i2_declaracion_islr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_declaracion_id', 'numero_planilla', 'num_certificado_elec', 'fecha', 'total_ingresos', 'total_egresos', 'impuesto_determinado', 'impuesto_pagado', 'contratista_id', 'anho'], 'required'],
            [['tipo_declaracion_id', 'numero_planilla', 'creado_por', 'actualizado_por', 'contratista_id'], 'integer'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['total_ingresos', 'total_egresos', 'impuesto_determinado', 'impuesto_pagado'], 'number'],
            [['sys_status'], 'boolean'],
            [['num_certificado_elec'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100],
            [['tipo_declaracion_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['tipo_declaracion_id', 'contratista_id', 'anho'], 'message' => 'Este tipo de declaración ya se encuentra cargada.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_declaracion_id' => Yii::t('app', 'Tipo de Declaracion'),
            'numero_planilla' => Yii::t('app', 'Número de Planilla'),
            'num_certificado_elec' => Yii::t('app', 'Número de Certificado Electrónico'),
            'fecha' => Yii::t('app', 'Fecha'),
            'total_ingresos' => Yii::t('app', 'Total de Ingresos'),
            'total_egresos' => Yii::t('app', 'Total de Egresos'),
            'impuesto_determinado' => Yii::t('app', 'Impuesto Determinado'),
            'impuesto_pagado' => Yii::t('app', 'Impuesto Pagado'),
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
    public function getTipoDeclaracion()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'tipo_declaracion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'tipo_declaracion_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasSysConceptos::concepto('i2.2'),'id','nombre'),
                'options'=>['id'=>'declaración-islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'numero_planilla' =>['type'=>Form::INPUT_TEXT,],
            'num_certificado_elec' => ['type'=>Form::INPUT_TEXT,],
            'fecha' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>DatePicker::className(), 'options'=>['options' => ['placeholder' => 'Seleccione fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy ',
                    //'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]]],
            'total_ingresos' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'total_egresos' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'impuesto_determinado' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'impuesto_pagado' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],

        ];
    }

    public function Calculo(){

        //$this->saldo_cierre = $this->saldo_ph + $this->importe_pagado_ejer_econo + $this->monto + $this->importe_aplicado_ejer_econo;

        return true;
    }
}

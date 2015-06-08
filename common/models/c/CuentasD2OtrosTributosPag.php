<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "cuentas.d2_otros_tributos_pag".
 *
 * @property integer $id
 * @property integer $otros_tributos_id
 * @property string $saldo_pah
 * @property string $credito_fiscal
 * @property string $monto
 * @property string $debito_fiscal
 * @property string $debito_fiscal_no
 * @property string $importe_pagado
 * @property string $saldo_cierre
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasConceptos $otrosTributos
 * @property Contratistas $contratista
 * @property CuentasD1D2Beneficiario $otrosTributosBeneficiarios
 */
class CuentasD2OtrosTributosPag extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.d2_otros_tributos_pag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['otros_tributos_id', 'saldo_pah', 'credito_fiscal', 'monto', 'debito_fiscal', 'debito_fiscal_no', 'importe_pagado', 'contratista_id', 'anho'], 'required'],
            [['otros_tributos_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_pah', 'credito_fiscal', 'monto', 'debito_fiscal', 'debito_fiscal_no', 'importe_pagado', 'saldo_cierre'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['otros_tributos_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['otros_tributos_id', 'contratista_id', 'anho'], 'message' => 'Este tributo ya ha sido cargado.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'otros_tributos_id' => Yii::t('app', 'Otros Tributos'),
            'saldo_pah' => Yii::t('app', 'Saldo Periodo anterior (Histórico)'),
            'credito_fiscal' => Yii::t('app', 'Credito Fiscal'),
            'monto' => Yii::t('app', 'Monto'),
            'debito_fiscal' => Yii::t('app', 'Debito Fiscal'),
            'debito_fiscal_no' => Yii::t('app', 'Debito Fiscal Numero'),
            'importe_pagado' => Yii::t('app', 'Importe Pagado'),
            'saldo_cierre' => Yii::t('app', 'Saldo al Cierre'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrosTributos()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'otros_tributos_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrosTributosBeneficiarios()
    {
        return $this->hasMany(CuentasD1D2Beneficiario::className(), ['cuenta_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'otros_tributos_id' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasSysConceptos::concepto('d2'),'id','nombre'),
                'options'=>['id'=>'otros_tributos-concepto','placeholder'=>'Seleccionar', 'onchange'=>''],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'saldo_pah' =>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'credito_fiscal' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'monto' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'debito_fiscal' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'debito_fiscal_no' => ['type'=>Form::INPUT_TEXT,],
            'importe_pagado' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'saldo_cierre' => ['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


        ];
    }

    public function Calculo(){

        //$this->saldo_cierre = $this->saldo_ph + $this->importe_pagado_ejer_econo + $this->monto + $this->importe_aplicado_ejer_econo;

        return true;
    }
}

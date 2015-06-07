<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\checkbox\CheckboxX;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;

/**
 * This is the model class for table "cuentas.d1_islr_pagado_anticipo".
 *
 * @property integer $id
 * @property integer $islr_pagado_id
 * @property string $nro_documento
 * @property string $saldo_ph
 * @property string $importe_pagado_ejer_econo
 * @property string $importe_aplicado_ejer_econo
 * @property string $saldo_cierre
 * @property string $monto
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasConceptos $islrPagado
 * @property CuentasD1D2Beneficiario $islrBeneficiarios
 * @property Contratistas $contratista
 */
class CuentasD1IslrPagadoAnticipo extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.d1_islr_pagado_anticipo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['islr_pagado_id', 'saldo_ph', 'importe_pagado_ejer_econo', 'importe_aplicado_ejer_econo', 'contratista_id', 'monto', 'anho'], 'required'],
            [['islr_pagado_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['nro_documento'], 'string'],
            [['saldo_ph', 'importe_pagado_ejer_econo', 'importe_aplicado_ejer_econo', 'saldo_cierre', 'monto'], 'number'],
            ['monto', 'default', 'value'=>0],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['islr_pagado_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['islr_pagado_id', 'contratista_id', 'anho'], 'message' => 'Ya se encuentra cargado un registro con este concepto.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'islr_pagado_id' => Yii::t('app', 'Islr Pagado'),
            'nro_documento' => Yii::t('app', 'Nro Documento'),
            'saldo_ph' => Yii::t('app', 'Saldo Ph'),
            'importe_pagado_ejer_econo' => Yii::t('app', 'Importe Pagado Ejercicio Económico'),
            'importe_aplicado_ejer_econo' => Yii::t('app', 'Importe Aplicado Ejercicio Económico'),
            'saldo_cierre' => Yii::t('app', 'Saldo al Cierre'),
            'monto' => Yii::t('app', 'Monto'),
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
    public function getIslrPagado()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'islr_pagado_id']);
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
    public function getIslrBeneficiarios()
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

                'islr_pagado_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasSysConceptos::concepto('d1'),'id','nombre'),
                    'options'=>['id'=>'islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>''],'pluginOptions' => [
                        'allowClear' => false,
                    ],]],
                'nro_documento'=>['type'=>Form::INPUT_TEXT,],
                'saldo_ph'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
                'importe_pagado_ejer_econo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],/*['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskedInput::className(),'options'=>[
                'clientOptions' => [
                    'autoUnmask'=> true,
                    'removeMaskOnSubmit'=>true,
                    //'definitions'=>['maskSymbol'=>'Bs. '],
                    'alias' =>  'decimal',
                    'groupSeparator' => '.',
                    'radixPoint' => ',',
                    //'mask'=>'9{1,38}',
                    'autoGroup' => true
                ],]
            ],//*/
                'monto'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
                'importe_aplicado_ejer_econo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
                //'saldo_cierre'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


            ];
    }

    public function Calculo(){

        $this->saldo_cierre = $this->saldo_ph + $this->importe_pagado_ejer_econo + $this->monto + $this->importe_aplicado_ejer_econo;

        return true;
    }
}

<?php

namespace common\models\c;

use kartik\builder\Form;
use kartik\checkbox\CheckboxX;
use kartik\money\MaskMoney;
use kartik\widgets\Select2;
use Yii;
use yii\helpers\ArrayHelper;

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
            [['islr_pagado_id', 'saldo_ph', 'importe_pagado_ejer_econo', 'importe_aplicado_ejer_econo', 'contratista_id', 'anho'], 'required'],
            [['islr_pagado_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['nro_documento'], 'string'],
            [['saldo_ph', 'importe_pagado_ejer_econo', 'importe_aplicado_ejer_econo', 'saldo_cierre', 'monto'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['islr_pagado_id', 'contratista_id'], 'unique', 'targetAttribute' => ['islr_pagado_id', 'contratista_id'], 'message' => 'Ya se encuentra cargado un registro con este concepto.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'islr_pagado_id' => Yii::t('app', 'Islr Pagado ID'),
            'nro_documento' => Yii::t('app', 'Nro Documento'),
            'saldo_ph' => Yii::t('app', 'Saldo Ph'),
            'importe_pagado_ejer_econo' => Yii::t('app', 'Importe Pagado Ejer Econo'),
            'importe_aplicado_ejer_econo' => Yii::t('app', 'Importe Aplicado Ejer Econo'),
            'saldo_cierre' => Yii::t('app', 'Saldo Cierre'),
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
        return $this->hasOne(CuentasConceptos::className(), ['id' => 'islr_pagado_id']);
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

            'islr_pagado_id'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>Select2::classname(),'options'=>['data'=>ArrayHelper::map(CuentasConceptos::concepto('d1'),'id','nombre'),
                'options'=>['id'=>'islr-concepto','placeholder'=>'Seleccionar ', 'onchange'=>'js:'],'pluginOptions' => [
                    'allowClear' => false,
                ],]],
            'nro_documento'=>['type'=>Form::INPUT_TEXT,],
            'saldo_ph'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'importe_pagado_ejer_econo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            'importe_aplicado_ejer_econo'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],
            //'saldo_cierre'=>['type'=>Form::INPUT_WIDGET,'widgetClass'=>MaskMoney::className(),],


        ];
    }
}

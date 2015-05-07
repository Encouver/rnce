<?php

namespace common\models\c;

use kartik\builder\TabularForm;
use Yii;

/**
 * This is the model class for table "cuentas.aa_obligaciones_bancarias".
 *
 * @property integer $id
 * @property boolean $corriente
 * @property integer $banco_id
 * @property string $num_documento
 * @property string $monto_otorgado
 * @property string $fecha_prestamo
 * @property string $fecha_vencimiento
 * @property string $tasa_interes
 * @property integer $condicion_pago_id
 * @property integer $plazo
 * @property integer $tipo_garantia_id
 * @property string $interes_ejer_econ
 * @property string $interes_pagar
 * @property string $importe_deuda
 * @property integer $total_imp_deu_int
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property AaCondicionesPagos $condicionPago
 * @property AaTiposGarantias $tipoGarantia
 * @property SysTotales $totalImpDeuInt
 * @property SysBancos $banco
 */
class AaObligacionesBancarias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.aa_obligaciones_bancarias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['corriente', 'banco_id', 'num_documento', 'monto_otorgado', 'fecha_prestamo', 'fecha_vencimiento', 'tasa_interes', 'condicion_pago_id', 'plazo', 'tipo_garantia_id', 'interes_ejer_econ', 'interes_pagar', 'importe_deuda', 'total_imp_deu_int', 'contratista_id', 'anho', 'creado_por', 'actualizado_por'], 'required'],
            [['corriente', 'sys_status'], 'boolean'],
            [['banco_id', 'condicion_pago_id', 'plazo', 'tipo_garantia_id', 'total_imp_deu_int', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['monto_otorgado', 'tasa_interes', 'interes_ejer_econ', 'interes_pagar', 'importe_deuda'], 'number'],
            [['fecha_prestamo', 'fecha_vencimiento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_documento'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'corriente' => Yii::t('app', 'Corriente'),
            'banco_id' => Yii::t('app', 'Banco ID'),
            'num_documento' => Yii::t('app', 'Num Documento'),
            'monto_otorgado' => Yii::t('app', 'Monto Otorgado'),
            'fecha_prestamo' => Yii::t('app', 'Fecha Prestamo'),
            'fecha_vencimiento' => Yii::t('app', 'Fecha Vencimiento'),
            'tasa_interes' => Yii::t('app', 'Tasa Interes'),
            'condicion_pago_id' => Yii::t('app', 'Condicion Pago ID'),
            'plazo' => Yii::t('app', 'Plazo'),
            'tipo_garantia_id' => Yii::t('app', 'Tipo Garantia ID'),
            'interes_ejer_econ' => Yii::t('app', 'Interes Ejer Econ'),
            'interes_pagar' => Yii::t('app', 'Interes Pagar'),
            'importe_deuda' => Yii::t('app', 'Importe Deuda'),
            'total_imp_deu_int' => Yii::t('app', 'Total Imp Deu Int'),
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
    public function getCondicionPago()
    {
        return $this->hasOne(AaCondicionesPagos::className(), ['id' => 'condicion_pago_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoGarantia()
    {
        return $this->hasOne(AaTiposGarantias::className(), ['id' => 'tipo_garantia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTotalImpDeuInt()
    {
        return $this->hasOne(SysTotales::className(), ['id' => 'total_imp_deu_int']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(SysBancos::className(), ['id' => 'banco_id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>TabularForm::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'corriente'=>['type'=>TabularForm::INPUT_CHECKBOX,'label'=>'Corriente'],
        ];
    }
}

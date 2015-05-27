<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.b1_cuentas_por_cobrar_comerciales".
 *
 * @property integer $id
 * @property string $concepto
 * @property string $num_fact_contr
 * @property string $monto
 * @property string $porcentaje
 * @property boolean $corriente
 * @property boolean $nocorriente
 * @property integer $plazo_contrato_c
 * @property string $saldo_c
 * @property boolean $deterioro_c
 * @property string $valor_de_uso_c
 * @property string $saldo_neto_c
 * @property integer $plazo_contrato_nc
 * @property string $saldo_nc
 * @property boolean $deterioro_nc
 * @property string $valor_de_uso_nc
 * @property string $saldo_neto_nc
 * @property string $intereses
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 */
class CuentasB1CuentasPorCobrarComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.b1_cuentas_por_cobrar_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['concepto', 'monto', 'porcentaje', 'contratista_id', 'anho'], 'required'],
            [['monto', 'porcentaje', 'saldo_c', 'valor_de_uso_c', 'saldo_neto_c', 'saldo_nc', 'valor_de_uso_nc', 'saldo_neto_nc', 'intereses'], 'number'],
            [['corriente', 'nocorriente', 'deterioro_c', 'deterioro_nc', 'sys_status'], 'boolean'],
            [['plazo_contrato_c', 'plazo_contrato_nc', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['concepto', 'num_fact_contr'], 'string', 'max' => 255],
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
            'concepto' => Yii::t('app', 'Concepto'),
            'num_fact_contr' => Yii::t('app', 'Num Fact Contr'),
            'monto' => Yii::t('app', 'Monto'),
            'porcentaje' => Yii::t('app', 'Porcentaje'),
            'corriente' => Yii::t('app', 'Corriente'),
            'nocorriente' => Yii::t('app', 'Nocorriente'),
            'plazo_contrato_c' => Yii::t('app', 'Plazo Contrato C'),
            'saldo_c' => Yii::t('app', 'Saldo C'),
            'deterioro_c' => Yii::t('app', 'Deterioro C'),
            'valor_de_uso_c' => Yii::t('app', 'Valor De Uso C'),
            'saldo_neto_c' => Yii::t('app', 'Saldo Neto C'),
            'plazo_contrato_nc' => Yii::t('app', 'Plazo Contrato Nc'),
            'saldo_nc' => Yii::t('app', 'Saldo Nc'),
            'deterioro_nc' => Yii::t('app', 'Deterioro Nc'),
            'valor_de_uso_nc' => Yii::t('app', 'Valor De Uso Nc'),
            'saldo_neto_nc' => Yii::t('app', 'Saldo Neto Nc'),
            'intereses' => Yii::t('app', 'Intereses'),
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
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

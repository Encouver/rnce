<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.b2_otras_cuentas_por_cobrar_e".
 *
 * @property integer $id
 * @property string $criterio
 * @property string $origen
 * @property string $fecha
 * @property string $garantia
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
 * @property string $otro_nombre
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
class CuentasB2OtrasCuentasPorCobrarE extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.b2_otras_cuentas_por_cobrar_e';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['criterio', 'origen', 'fecha', 'contratista_id', 'anho'], 'required'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['corriente', 'nocorriente', 'deterioro_c', 'deterioro_nc', 'sys_status'], 'boolean'],
            [['plazo_contrato_c', 'plazo_contrato_nc', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_c', 'valor_de_uso_c', 'saldo_neto_c', 'saldo_nc', 'valor_de_uso_nc', 'saldo_neto_nc'], 'number'],
            [['criterio', 'origen', 'garantia', 'otro_nombre'], 'string', 'max' => 255],
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
            'criterio' => Yii::t('app', 'Criterio'),
            'origen' => Yii::t('app', 'Origen'),
            'fecha' => Yii::t('app', 'Fecha'),
            'garantia' => Yii::t('app', 'Garantia'),
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
            'otro_nombre' => Yii::t('app', 'Otro Nombre'),
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

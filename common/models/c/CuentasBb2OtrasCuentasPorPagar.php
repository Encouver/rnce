<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.bb2_otras_cuentas_por_pagar".
 *
 * @property integer $id
 * @property string $criterio
 * @property string $fecha
 * @property integer $garantia
 * @property integer $plazo
 * @property string $saldo_conta_co
 * @property string $saldo_conta_nc
 * @property string $intereses
 * @property integer $criterio_id
 * @property string $otro_nombre
 * @property string $detalle
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasBb2Garantias $garantia0
 * @property Contratistas $contratista
 */
class CuentasBb2OtrasCuentasPorPagar extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.bb2_otras_cuentas_por_pagar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['criterio', 'fecha', 'garantia', 'plazo', 'saldo_conta_co', 'saldo_conta_nc', 'detalle', 'contratista_id', 'anho'], 'required'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['garantia', 'plazo', 'criterio_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_conta_co', 'saldo_conta_nc', 'intereses'], 'number'],
            [['detalle'], 'string'],
            [['sys_status'], 'boolean'],
            [['criterio', 'otro_nombre'], 'string', 'max' => 255],
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
            'fecha' => Yii::t('app', 'Fecha'),
            'garantia' => Yii::t('app', 'Garantia'),
            'plazo' => Yii::t('app', 'Plazo'),
            'saldo_conta_co' => Yii::t('app', 'Saldo Conta Co'),
            'saldo_conta_nc' => Yii::t('app', 'Saldo Conta Nc'),
            'intereses' => Yii::t('app', 'Intereses'),
            'criterio_id' => Yii::t('app', 'Criterio ID'),
            'otro_nombre' => Yii::t('app', 'Otro Nombre'),
            'detalle' => Yii::t('app', 'Detalle'),
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
    public function getGarantia0()
    {
        return $this->hasOne(CuentasBb2Garantias::className(), ['id' => 'garantia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

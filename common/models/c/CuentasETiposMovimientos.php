<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.e_tipos_movimientos".
 *
 * @property integer $id
 * @property integer $e_inversion_id
 * @property integer $movimiento_id
 * @property string $fecha
 * @property string $monto_nominal
 * @property string $monto_nominal_ajustado
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasEInversiones $eInversion
 * @property CuentasEMovimientos $movimiento
 */
class CuentasETiposMovimientos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.e_tipos_movimientos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['e_inversion_id', 'movimiento_id', 'fecha', 'monto_nominal', 'monto_nominal_ajustado'], 'required'],
            [['e_inversion_id', 'movimiento_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['monto_nominal', 'monto_nominal_ajustado'], 'number'],
            [['sys_status'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'e_inversion_id' => Yii::t('app', 'E Inversion ID'),
            'movimiento_id' => Yii::t('app', 'Movimiento ID'),
            'fecha' => Yii::t('app', 'Fecha'),
            'monto_nominal' => Yii::t('app', 'Monto Nominal'),
            'monto_nominal_ajustado' => Yii::t('app', 'Monto Nominal Ajustado'),
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
    public function getEInversion()
    {
        return $this->hasOne(CuentasEInversiones::className(), ['id' => 'e_inversion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovimiento()
    {
        return $this->hasOne(CuentasEMovimientos::className(), ['id' => 'movimiento_id']);
    }
}

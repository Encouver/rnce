<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.fondos_emergencias".
 *
 * @property integer $id
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $fecha_cierre
 * @property string $saldo_fondo
 * @property string $monto_perdida
 * @property string $monto_utilizado
 * @property string $monto_asociados
 * @property boolean $corto_plazo
 * @property integer $numero_plazo
 * @property boolean $interes
 * @property double $tasa_interes
 * @property string $saldo_fondo_actual
 * @property string $monto_actual
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class FondosEmergencias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.fondos_emergencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acta_constitutiva_id', 'fecha_cierre', 'saldo_fondo', 'monto_perdida', 'monto_utilizado', 'corto_plazo', 'numero_plazo', 'interes', 'saldo_fondo_actual', 'monto_actual'], 'required'],
            [['acta_constitutiva_id', 'numero_plazo'], 'integer'],
            [['sys_status', 'corto_plazo', 'interes'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_cierre'], 'safe'],
            [['saldo_fondo', 'monto_perdida', 'monto_utilizado', 'monto_asociados', 'tasa_interes', 'saldo_fondo_actual', 'monto_actual'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'saldo_fondo' => Yii::t('app', 'Saldo Fondo'),
            'monto_perdida' => Yii::t('app', 'Monto Perdida'),
            'monto_utilizado' => Yii::t('app', 'Monto Utilizado'),
            'monto_asociados' => Yii::t('app', 'Monto Asociados'),
            'corto_plazo' => Yii::t('app', 'Corto Plazo'),
            'numero_plazo' => Yii::t('app', 'Numero Plazo'),
            'interes' => Yii::t('app', 'Interes'),
            'tasa_interes' => Yii::t('app', 'Tasa Interes'),
            'saldo_fondo_actual' => Yii::t('app', 'Saldo Fondo Actual'),
            'monto_actual' => Yii::t('app', 'Monto Actual'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }
}

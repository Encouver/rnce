<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.capitales_efectivos".
 *
 * @property integer $id
 * @property string $numero_transaccion
 * @property double $monto
 * @property string $fecha
 * @property integer $sys_banco_id
 * @property integer $cuenta_contratista_id
 * @property integer $capital_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $cuentaContratista
 * @property SysBancos $sysBanco
 */
class CapitalesEfectivos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.capitales_efectivos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_transaccion', 'monto', 'fecha', 'sys_banco_id', 'cuenta_contratista_id', 'capital_id'], 'required'],
            [['monto'], 'number'],
            [['fecha', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_banco_id', 'cuenta_contratista_id', 'capital_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['numero_transaccion'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_transaccion' => Yii::t('app', 'Numero Transaccion'),
            'monto' => Yii::t('app', 'Monto'),
            'fecha' => Yii::t('app', 'Fecha'),
            'sys_banco_id' => Yii::t('app', 'Sys Banco ID'),
            'cuenta_contratista_id' => Yii::t('app', 'Cuenta Contratista ID'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentaContratista()
    {
        return $this->hasOne(Capitales::className(), ['id' => 'cuenta_contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysBanco()
    {
        return $this->hasOne(SysBancos::className(), ['id' => 'sys_banco_id']);
    }
}

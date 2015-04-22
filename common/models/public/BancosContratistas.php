<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.bancos_contratistas".
 *
 * @property integer $id
 * @property integer $banco_id
 * @property integer $contratista_id
 * @property string $num_cuenta
 * @property string $tipo_moneda
 * @property string $tipo_cuenta
 * @property string $estatus_cuenta
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property SysBancos $banco
 */
class BancosContratistas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.bancos_contratistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_id', 'contratista_id', 'num_cuenta', 'tipo_moneda', 'tipo_cuenta', 'estatus_cuenta'], 'required'],
            [['banco_id', 'contratista_id'], 'integer'],
            [['num_cuenta', 'tipo_moneda', 'tipo_cuenta', 'estatus_cuenta'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_cuenta'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'banco_id' => Yii::t('app', 'Banco ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'num_cuenta' => Yii::t('app', 'Num Cuenta'),
            'tipo_moneda' => Yii::t('app', 'Tipo Moneda'),
            'tipo_cuenta' => Yii::t('app', 'Tipo Cuenta'),
            'estatus_cuenta' => Yii::t('app', 'Estatus Cuenta'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(SysBancos::className(), ['id' => 'banco_id']);
    }
}

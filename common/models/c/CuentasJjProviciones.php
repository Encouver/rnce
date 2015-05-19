<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.jj_proviciones".
 *
 * @property integer $id
 * @property string $concepto
 * @property string $saldo_p_anterior
 * @property string $importe_provisionado_periodo
 * @property string $aplicacion_amortizacion
 * @property string $saldo_al_cierre
 * @property boolean $corriente
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
class CuentasJjProviciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.jj_proviciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['concepto', 'saldo_p_anterior', 'importe_provisionado_periodo', 'aplicacion_amortizacion', 'saldo_al_cierre', 'contratista_id', 'anho'], 'required'],
            [['saldo_p_anterior', 'importe_provisionado_periodo', 'aplicacion_amortizacion', 'saldo_al_cierre'], 'number'],
            [['corriente', 'sys_status'], 'boolean'],
            [['contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['concepto'], 'string', 'max' => 255],
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
            'saldo_p_anterior' => Yii::t('app', 'Saldo P Anterior'),
            'importe_provisionado_periodo' => Yii::t('app', 'Importe Provisionado Periodo'),
            'aplicacion_amortizacion' => Yii::t('app', 'Aplicacion Amortizacion'),
            'saldo_al_cierre' => Yii::t('app', 'Saldo Al Cierre'),
            'corriente' => Yii::t('app', 'Corriente'),
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

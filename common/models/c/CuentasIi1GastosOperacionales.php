<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.ii1_gastos_operacionales".
 *
 * @property integer $id
 * @property string $tipo_gasto
 * @property string $ventas_hist
 * @property string $ventas_ajustado
 * @property string $admin_hist
 * @property string $admin_ajustado
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
class CuentasIi1GastosOperacionales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.ii1_gastos_operacionales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_gasto', 'ventas_hist', 'ventas_ajustado', 'admin_hist', 'admin_ajustado', 'contratista_id', 'anho'], 'required'],
            [['ventas_hist', 'ventas_ajustado', 'admin_hist', 'admin_ajustado'], 'number'],
            [['contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_gasto'], 'string', 'max' => 255],
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
            'tipo_gasto' => Yii::t('app', 'Tipo Gasto'),
            'ventas_hist' => Yii::t('app', 'Ventas Hist'),
            'ventas_ajustado' => Yii::t('app', 'Ventas Ajustado'),
            'admin_hist' => Yii::t('app', 'Admin Hist'),
            'admin_ajustado' => Yii::t('app', 'Admin Ajustado'),
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

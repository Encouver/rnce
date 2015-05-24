<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.conceptos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $cuenta
 *
 * @property CuentasHhPasivoLaboral[] $cuentasHhPasivoLaborals
 * @property CuentasJjProviciones[] $cuentasJjProviciones
 */
class CuentasConceptos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.conceptos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre', 'descripcion', 'cuenta'], 'string', 'max' => 255],
            [['nombre', 'cuenta'], 'unique', 'targetAttribute' => ['nombre', 'cuenta'], 'message' => 'The combination of Nombre and Cuenta has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'cuenta' => Yii::t('app', 'Cuenta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasHhPasivoLaborals()
    {
        return $this->hasMany(CuentasHhPasivoLaboral::className(), ['hh_concepto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasJjProviciones()
    {
        return $this->hasMany(CuentasJjProviciones::className(), ['concepto_id' => 'id']);
    }
}

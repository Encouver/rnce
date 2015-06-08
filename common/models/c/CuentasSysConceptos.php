<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.sys_conceptos".
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
 * @property integer $sys_clasificacion_id
 * @property boolean $carga_sistema
 *
 * @property CuentasD1IslrPagadoAnticipo[] $cuentasD1IslrPagadoAnticipos
 * @property CuentasD2OtrosTributosPag[] $cuentasD2OtrosTributosPags
 * @property CuentasDd3OtrosTributos[] $cuentasDd3OtrosTributos
 * @property CuentasHhPasivoLaboral[] $cuentasHhPasivoLaborals
 * @property CuentasI2DeclaracionIslr[] $cuentasI2DeclaracionIslrs
 * @property CuentasJjProviciones[] $cuentasJjProviciones
 * @property CuentasSysClasificacionesConceptos $sysClasificacion
 */
class CuentasSysConceptos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.sys_conceptos';
    }

    public static function Concepto($cuenta = '')
    {
        return CuentasSysConceptos::find()->where(['cuenta'=>$cuenta])->orderBy('id')->all();
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['creado_por', 'actualizado_por', 'sys_clasificacion_id'], 'integer'],
            [['sys_status', 'carga_sistema'], 'boolean'],
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
            'sys_clasificacion_id' => Yii::t('app', 'Sys Clasificacion ID'),
            'carga_sistema' => Yii::t('app', 'Carga Sistema'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasD1IslrPagadoAnticipos()
    {
        return $this->hasMany(CuentasD1IslrPagadoAnticipo::className(), ['islr_pagado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasD2OtrosTributosPags()
    {
        return $this->hasMany(CuentasD2OtrosTributosPag::className(), ['otros_tributos_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasDd3OtrosTributos()
    {
        return $this->hasMany(CuentasDd3OtrosTributos::className(), ['concepto_id' => 'id']);
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
    public function getCuentasI2DeclaracionIslrs()
    {
        return $this->hasMany(CuentasI2DeclaracionIslr::className(), ['tipo_declaracion_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasJjProviciones()
    {
        return $this->hasMany(CuentasJjProviciones::className(), ['concepto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysClasificacion()
    {
        return $this->hasOne(CuentasSysClasificacionesConceptos::className(), ['id' => 'sys_clasificacion_id']);
    }
}

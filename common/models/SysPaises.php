<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_paises".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property PersonasNaturales[] $personasNaturales
 * @property SysEstados[] $sysEstados
 * @property SysBancos[] $sysBancos
 * @property PolizasContratadas[] $polizasContratadas
 * @property ObjetosAutorizaciones[] $objetosAutorizaciones
 */
class SysPaises extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_paises';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'sys_status' => 'Sys Status',
            'sys_creado_el' => 'Sys Creado El',
            'sys_actualizado_el' => 'Sys Actualizado El',
            'sys_finalizado_el' => 'Sys Finalizado El',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonasNaturales()
    {
        return $this->hasMany(PersonasNaturales::className(), ['sys_pais_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysEstados()
    {
        return $this->hasMany(SysEstados::className(), ['sys_pais_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysBancos()
    {
        return $this->hasMany(SysBancos::className(), ['sys_pais_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolizasContratadas()
    {
        return $this->hasMany(PolizasContratadas::className(), ['sys_pais_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosAutorizaciones()
    {
        return $this->hasMany(ObjetosAutorizaciones::className(), ['origen_producto_id' => 'id']);
    }
}

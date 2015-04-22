<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sys_municipios".
 *
 * @property integer $id
 * @property integer $sys_estado_id
 * @property string $nombre
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Direcciones[] $direcciones
 * @property SysParroquias[] $sysParroquias
 * @property SysEstados $sysEstado
 */
class SysMunicipios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_estado_id', 'nombre'], 'required'],
            [['sys_estado_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sys_estado_id' => 'Sys Estado ID',
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
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::className(), ['sys_municipio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysParroquias()
    {
        return $this->hasMany(SysParroquias::className(), ['sys_municipio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysEstado()
    {
        return $this->hasOne(SysEstados::className(), ['id' => 'sys_estado_id']);
    }
}

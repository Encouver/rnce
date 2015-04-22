<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_estados".
 *
 * @property integer $id
 * @property integer $sys_pais_id
 * @property string $nombre
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Direcciones[] $direcciones
 * @property SysCiudades[] $sysCiudades
 * @property SysPaises $sysPais
 * @property SysMunicipios[] $sysMunicipios
 */
class SysEstados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_estados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_pais_id', 'nombre'], 'required'],
            [['sys_pais_id'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'sys_pais_id' => Yii::t('app', 'Sys Pais ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDirecciones()
    {
        return $this->hasMany(Direcciones::className(), ['sys_estado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysCiudades()
    {
        return $this->hasMany(SysCiudades::className(), ['sys_estado_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysPais()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'sys_pais_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMunicipios()
    {
        return $this->hasMany(SysMunicipios::className(), ['sys_estado_id' => 'id']);
    }
}

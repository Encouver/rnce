<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_municipios".
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
 * @property SysEstados $sysEstado
 * @property SysParroquias[] $sysParroquias
 */
class SysMunicipios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_municipios';
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
            'id' => Yii::t('app', 'ID'),
            'sys_estado_id' => Yii::t('app', 'Sys Estado ID'),
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
        return $this->hasMany(Direcciones::className(), ['sys_municipio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysEstado()
    {
        return $this->hasOne(SysEstados::className(), ['id' => 'sys_estado_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysParroquias()
    {
        return $this->hasMany(SysParroquias::className(), ['sys_municipio_id' => 'id']);
    }
}

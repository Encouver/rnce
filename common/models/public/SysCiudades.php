<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_ciudades".
 *
 * @property integer $id
 * @property integer $sys_estado_id
 * @property string $nombre
 * @property string $codigo_postal
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property SysEstados $sysEstado
 */
class SysCiudades extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_ciudades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_estado_id', 'nombre', 'codigo_postal'], 'required'],
            [['sys_estado_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre', 'codigo_postal'], 'string', 'max' => 255],
            [['sys_estado_id', 'nombre'], 'unique', 'targetAttribute' => ['sys_estado_id', 'nombre'], 'message' => 'The combination of Sys Estado ID and Nombre has already been taken.']
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
            'codigo_postal' => Yii::t('app', 'Codigo Postal'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysEstado()
    {
        return $this->hasOne(SysEstados::className(), ['id' => 'sys_estado_id']);
    }
}

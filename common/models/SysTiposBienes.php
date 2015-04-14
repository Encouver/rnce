<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activos.sys_tipos_bienes".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $sys_status
 * @property string $sys_fecha
 * @property string $descripcion
 * @property integer $sys_clasificacion_bien_id
 *
 * @property MejorasPropiedades[] $mejorasPropiedades
 * @property SysClasificacionesBien $sysClasificacionBien
 */
class SysTiposBienes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_tipos_bienes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'sys_clasificacion_bien_id'], 'required'],
            [['sys_status'], 'boolean'],
            [['sys_fecha'], 'safe'],
            [['sys_clasificacion_bien_id'], 'integer'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
            [['nombre'], 'unique']
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
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_fecha' => Yii::t('app', 'Sys Fecha'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'sys_clasificacion_bien_id' => Yii::t('app', 'Clasificacion bien'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMejorasPropiedades()
    {
        return $this->hasMany(MejorasPropiedades::className(), ['sys_tipo_bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysClasificacionBien()
    {
        return $this->hasOne(SysClasificacionesBienes::className(), ['id' => 'sys_clasificacion_bien_id']);
    }
}

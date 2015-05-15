<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_tipos_bienes".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $sys_clasificacion_bien_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes[] $activosBienes
 * @property ActivosMejorasPropiedades[] $activosMejorasPropiedades
 * @property ActivosSysClasificacionesBienes $sysClasificacionBien
 */
class ActivosSysTiposBienes extends \common\components\BaseActiveRecord
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
            [['sys_clasificacion_bien_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
            'descripcion' => Yii::t('app', 'Descripcion'),
            'sys_clasificacion_bien_id' => Yii::t('app', 'Sys Clasificacion Bien ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosBienes()
    {
        return $this->hasMany(ActivosBienes::className(), ['sys_tipo_bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosMejorasPropiedades()
    {
        return $this->hasMany(ActivosMejorasPropiedades::className(), ['sys_tipo_bien_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysClasificacionBien()
    {
        return $this->hasOne(ActivosSysClasificacionesBienes::className(), ['id' => 'sys_clasificacion_bien_id']);
    }
}

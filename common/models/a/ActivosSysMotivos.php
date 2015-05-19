<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_motivos".
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
 * @property integer $sys_clasificacion_motivo_id
 *
 * @property ActivosDesincorporacionActivos[] $activosDesincorporacionActivos
 * @property ActivosSysClasificacionesMotivos $sysClasificacionMotivo
 */
class ActivosSysMotivos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_motivos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['creado_por', 'actualizado_por', 'sys_clasificacion_motivo_id'], 'integer'],
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
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'sys_clasificacion_motivo_id' => Yii::t('app', 'Sys Clasificacion Motivo ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivosDesincorporacionActivos()
    {
        return $this->hasMany(ActivosDesincorporacionActivos::className(), ['sys_motivo_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysClasificacionMotivo()
    {
        return $this->hasOne(ActivosSysClasificacionesMotivos::className(), ['id' => 'sys_clasificacion_motivo_id']);
    }
}

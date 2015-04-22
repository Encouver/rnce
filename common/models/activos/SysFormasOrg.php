<?php

namespace common\models\activos;

use Yii;

/**
 * This is the model class for table "activos.sys_formas_org".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property MejorasPropiedades[] $mejorasPropiedades
 * @property Bienes[] $bienes
 */
class SysFormasOrg extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_formas_org';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['descripcion'], 'string'],
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
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMejorasPropiedades()
    {
        return $this->hasMany(MejorasPropiedades::className(), ['principio_contable_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBienes()
    {
        return $this->hasMany(Bienes::className(), ['principio_contable' => 'id']);
    }
}

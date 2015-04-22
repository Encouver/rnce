<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_subdenominaciones_comerciales".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $sys_denominacion_comercial_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property DenominacionesComerciales[] $denominacionesComerciales
 * @property SysDenominacionesComerciales $sysDenominacionComercial
 */
class SysSubdenominacionesComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_subdenominaciones_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_denominacion_comercial_id'], 'required'],
            [['sys_denominacion_comercial_id'], 'integer'],
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
            'nombre' => Yii::t('app', 'Nombre'),
            'sys_denominacion_comercial_id' => Yii::t('app', 'Sys Denominacion Comercial ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDenominacionesComerciales()
    {
        return $this->hasMany(DenominacionesComerciales::className(), ['sys_subdenominacion_comercial_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysDenominacionComercial()
    {
        return $this->hasOne(SysDenominacionesComerciales::className(), ['id' => 'sys_denominacion_comercial_id']);
    }
}

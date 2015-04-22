<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.inmuebles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $descripcion
 * @property string $direccion_ubicacion
 * @property string $ficha_catastral
 * @property string $zonificacion
 * @property string $extension
 * @property string $titulo_supletorio
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Bienes $bien
 */
class Inmuebles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.inmuebles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension'], 'required'],
            [['bien_id'], 'integer'],
            [['descripcion'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['direccion_ubicacion', 'ficha_catastral', 'zonificacion', 'extension', 'titulo_supletorio'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'direccion_ubicacion' => Yii::t('app', 'Direccion Ubicacion'),
            'ficha_catastral' => Yii::t('app', 'Ficha Catastral'),
            'zonificacion' => Yii::t('app', 'Zonificacion'),
            'extension' => Yii::t('app', 'Extension'),
            'titulo_supletorio' => Yii::t('app', 'Titulo Supletorio'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }
}

<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.sucursales".
 *
 * @property integer $persona_natural_id
 * @property integer $direccion_id
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $id
 * @property boolean $representante
 * @property boolean $accionista
 *
 * @property Contratistas $contratista
 * @property Direcciones $direccion
 * @property PersonasNaturales $personaNatural
 */
class Sucursales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sucursales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_natural_id', 'direccion_id', 'contratista_id', 'representante', 'accionista'], 'required'],
            [['persona_natural_id', 'direccion_id', 'contratista_id'], 'integer'],
            [['sys_status', 'representante', 'accionista'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'persona_natural_id' => Yii::t('app', 'Persona Natural ID'),
            'direccion_id' => Yii::t('app', 'Direccion ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'id' => Yii::t('app', 'ID'),
            'representante' => Yii::t('app', 'Representante'),
            'accionista' => Yii::t('app', 'Accionista'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDireccion()
    {
        return $this->hasOne(Direcciones::className(), ['id' => 'direccion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaNatural()
    {
        return $this->hasOne(PersonasNaturales::className(), ['id' => 'persona_natural_id']);
    }
}

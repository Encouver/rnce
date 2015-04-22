<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.sucursales".
 *
 * @property integer $id
 * @property integer $persona_natural_id
 * @property integer $direccion_id
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
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
            [['id', 'persona_natural_id', 'direccion_id', 'contratista_id'], 'required'],
            [['id', 'persona_natural_id', 'direccion_id', 'contratista_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'persona_natural_id' => Yii::t('app', 'Persona Natural ID'),
            'direccion_id' => Yii::t('app', 'Direccion ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
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

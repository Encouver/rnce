<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "sucursales".
 *
 * @property integer $direccion_id
 * @property integer $contratista_id
 * @property integer $id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $natural_juridica_id
 *
 * @property Contratistas $contratista
 * @property Direcciones $direccion
 * @property SysNaturalesJuridicas $naturalJuridica
 */
class Sucursales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sucursales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['direccion_id', 'contratista_id', 'natural_juridica_id'], 'required'],
            [['direccion_id', 'contratista_id', 'creado_por', 'actualizado_por', 'natural_juridica_id'], 'integer'],
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
            'direccion_id' => Yii::t('app', 'Direccion ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'id' => Yii::t('app', 'ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'natural_juridica_id' => Yii::t('app', 'Natural Juridica ID'),
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
    public function getNaturalJuridica()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridica_id']);
    }
}

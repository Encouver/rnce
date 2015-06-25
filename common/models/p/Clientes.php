<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.clientes".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $publico
 * @property integer $contratista_id
 * @property integer $natural_juridico_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property SysNaturalesJuridicas $naturalJuridico
 */
class Clientes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'contratista_id', 'natural_juridico_id'], 'required'],
            [['publico', 'sys_status'], 'boolean'],
            [['contratista_id', 'natural_juridico_id'], 'integer'],
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
            'publico' => Yii::t('app', 'Publico'),
            'contratista_id' => Yii::t('app', 'Contratista'),
            'natural_juridico_id' => Yii::t('app', 'Natural Juridico'),
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
    public function getNaturalJuridico()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['id' => 'natural_juridico_id']);
    }
}

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "nombres_cajas".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $contratistas_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_caja
 *
 * @property Contratistas $contratistas
 */
class NombresCajas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nombres_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'contratistas_id', 'tipo_caja'], 'required'],
            [['contratistas_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_caja'], 'string'],
            [['nombre'], 'string', 'max' => 255],
            [['nombre', 'contratistas_id'], 'unique', 'targetAttribute' => ['nombre', 'contratistas_id'], 'message' => 'The combination of Nombre and Contratistas ID has already been taken.']
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
            'contratistas_id' => Yii::t('app', 'Contratistas ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_caja' => Yii::t('app', 'Tipo Caja'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistas()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratistas_id']);
    }
}

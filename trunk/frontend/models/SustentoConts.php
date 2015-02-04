<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sustento_conts".
 *
 * @property integer $id
 * @property string $descripcion
 * @property integer $tipo_sustento_id
 * @property integer $contratista_id
 * @property string $ano
 *
 * @property Contratistas $contratista
 * @property TiposSustentos $tipoSustento
 */
class SustentoConts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sustento_conts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'tipo_sustento_id', 'contratista_id'], 'required'],
            [['tipo_sustento_id', 'contratista_id'], 'integer'],
            [['ano'], 'safe'],
            [['descripcion'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'tipo_sustento_id' => 'Tipo Sustento ID',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
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
    public function getTipoSustento()
    {
        return $this->hasOne(TiposSustentos::className(), ['id' => 'tipo_sustento_id']);
    }
}

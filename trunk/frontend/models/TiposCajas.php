<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_cajas".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $contratista_id
 * @property string $ano
 * @property boolean $activo
 *
 * @property EfectivoCaja[] $efectivoCajas
 * @property Contratistas $contratista
 */
class TiposCajas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_cajas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id'], 'required'],
            [['contratista_id'], 'integer'],
            [['ano'], 'safe'],
            [['activo'], 'boolean'],
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
            'id' => 'ID',
            'nombre' => 'Nombre',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfectivoCajas()
    {
        return $this->hasMany(EfectivoCaja::className(), ['tipo_caja_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

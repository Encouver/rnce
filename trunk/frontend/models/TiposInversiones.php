<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_inversiones".
 *
 * @property integer $id
 * @property string $nombre
 * @property boolean $activo
 * @property string $ano
 * @property string $descripcion
 *
 * @property Inversiones[] $inversiones
 */
class TiposInversiones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_inversiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'activo'], 'required'],
            [['activo'], 'boolean'],
            [['ano'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 255]
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
            'activo' => 'Activo',
            'ano' => 'Ano',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInversiones()
    {
        return $this->hasMany(Inversiones::className(), ['tipo_inversion' => 'id']);
    }
}

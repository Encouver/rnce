<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_sustentos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $tipo_cuenta
 * @property boolean $activo
 * @property string $ano
 *
 * @property SustentoConts[] $sustentoConts
 */
class TiposSustentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_sustentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'tipo_cuenta'], 'required'],
            [['activo'], 'boolean'],
            [['ano'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['tipo_cuenta'], 'string', 'max' => 200]
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
            'tipo_cuenta' => 'Tipo Cuenta',
            'activo' => 'Activo',
            'ano' => 'Ano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSustentoConts()
    {
        return $this->hasMany(SustentoConts::className(), ['tipo_sustento_id' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipos_deudores".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripción
 * @property boolean $activo
 *
 * @property OtrasCuentasCobrar[] $otrasCuentasCobrars
 */
class TiposDeudores extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipos_deudores';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripción'], 'required'],
            [['activo'], 'boolean'],
            [['nombre', 'descripción'], 'string', 'max' => 255],
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
            'descripción' => 'Descripción',
            'activo' => 'Activo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOtrasCuentasCobrars()
    {
        return $this->hasMany(OtrasCuentasCobrar::className(), ['tipo_deudor_id' => 'id']);
    }
}

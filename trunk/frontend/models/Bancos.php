<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bancos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $rif
 *
 * @property EfectivoBanco[] $efectivoBancos
 * @property BancosContratistas[] $bancosContratistas
 * @property Inversiones[] $inversiones
 */
class Bancos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bancos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'rif'], 'required'],
            [['nombre'], 'string', 'max' => 255],
            [['rif'], 'string', 'max' => 100]
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
            'rif' => 'Rif',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEfectivoBancos()
    {
        return $this->hasMany(EfectivoBanco::className(), ['banco_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancosContratistas()
    {
        return $this->hasMany(BancosContratistas::className(), ['banco_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInversiones()
    {
        return $this->hasMany(Inversiones::className(), ['banco_id' => 'id']);
    }
}

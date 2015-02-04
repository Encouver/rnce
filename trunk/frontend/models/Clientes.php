<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $rif
 * @property boolean $publico
 * @property integer $contratista_id
 *
 * @property Contratistas $contratista
 */
class Clientes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rif', 'publico', 'contratista_id'], 'required'],
            [['publico'], 'boolean'],
            [['contratista_id'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['rif'], 'string', 'max' => 10]
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
            'publico' => 'Publico',
            'contratista_id' => 'Contratista ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

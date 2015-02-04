<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notas_revelatorias".
 *
 * @property integer $id
 * @property string $nota
 * @property integer $usuario_id
 * @property integer $contratista_id
 * @property string $ano
 * @property integer $cuenta
 *
 * @property Contratistas $contratista
 * @property User $usuario
 */
class NotasRevelatorias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notas_revelatorias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nota', 'usuario_id', 'contratista_id', 'cuenta'], 'required'],
            [['nota'], 'string'],
            [['usuario_id', 'contratista_id', 'cuenta'], 'integer'],
            [['ano'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nota' => 'Nota',
            'usuario_id' => 'Usuario ID',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
            'cuenta' => 'Cuenta',
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
    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'usuario_id']);
    }
}

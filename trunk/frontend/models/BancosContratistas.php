<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bancos_contratistas".
 *
 * @property integer $id
 * @property integer $banco_id
 * @property integer $contratista_id
 * @property string $num_cuenta
 * @property string $ano
 *
 * @property Bancos $banco
 * @property Contratistas $contratista
 */
class BancosContratistas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bancos_contratistas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_id'], 'required'],
            [['banco_id'], 'integer'],
            [['ano'], 'safe'],
            [['num_cuenta'], 'string', 'max' => 150]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'banco_id' => 'Banco ID',
            'contratista_id' => 'Contratista ID',
            'num_cuenta' => 'Num Cuenta',
            'ano' => 'Ano',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBanco()
    {
        return $this->hasOne(Bancos::className(), ['id' => 'banco_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

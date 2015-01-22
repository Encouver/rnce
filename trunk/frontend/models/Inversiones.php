<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inversiones".
 *
 * @property integer $id
 * @property integer $banco_id
 * @property string $condiciones
 * @property string $costo_adquisicion
 * @property string $valor_desvalorizacion
 * @property string $saldo_contabilidad
 * @property integer $contratista_id
 * @property string $ano
 *
 * @property Bancos $banco
 * @property Contratistas $contratista
 */
class Inversiones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inversiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banco_id', 'condiciones', 'costo_adquisicion', 'valor_desvalorizacion', 'saldo_contabilidad', 'contratista_id', 'ano'], 'required'],
            [['banco_id', 'contratista_id'], 'integer'],
            [['costo_adquisicion', 'valor_desvalorizacion', 'saldo_contabilidad'], 'number'],
            [['ano'], 'safe'],
            [['condiciones'], 'string', 'max' => 250]
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
            'condiciones' => 'Condiciones',
            'costo_adquisicion' => 'Costo Adquisicion',
            'valor_desvalorizacion' => 'Valor Desvalorizacion',
            'saldo_contabilidad' => 'Saldo Contabilidad',
            'contratista_id' => 'Contratista ID',
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

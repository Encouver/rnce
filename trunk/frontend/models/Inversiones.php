<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inversiones".
 *
 * @property integer $id
 * @property integer $banco_id
 * @property string $costo_adquisicion
 * @property string $valor_desvalorizacion
 * @property integer $contratista_id
 * @property string $ano
 * @property boolean $activo
 * @property integer $plazo
 * @property string $tasa_interes
 * @property integer $tipo_inversion
 *
 * @property Bancos $banco
 * @property Contratistas $contratista
 * @property TiposInversiones $tipoInversion
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
            [['banco_id', 'costo_adquisicion', 'valor_desvalorizacion', 'contratista_id', 'ano', 'plazo', 'tasa_interes', 'tipo_inversion'], 'required'],
            [['banco_id', 'contratista_id', 'plazo', 'tipo_inversion'], 'integer'],
            [['costo_adquisicion', 'valor_desvalorizacion', 'tasa_interes'], 'number'],
            [['ano'], 'safe'],
            [['activo'], 'boolean']
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
            'costo_adquisicion' => 'Costo Adquisicion',
            'valor_desvalorizacion' => 'Valor Desvalorizacion',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
            'activo' => 'Activo',
            'plazo' => 'Plazo',
            'tasa_interes' => 'Tasa Interes',
            'tipo_inversion' => 'Tipo Inversion',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoInversion()
    {
        return $this->hasOne(TiposInversiones::className(), ['id' => 'tipo_inversion']);
    }
}

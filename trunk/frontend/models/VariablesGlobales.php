<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "variables_globales".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property string $campo
 * @property integer $cuenta_afectada
 * @property string $valor
 * @property string $ano
 *
 * @property Contratistas $contratista
 */
class VariablesGlobales extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'variables_globales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'campo', 'cuenta_afectada', 'valor'], 'required'],
            [['contratista_id', 'cuenta_afectada'], 'integer'],
            [['ano'], 'safe'],
            [['campo', 'valor'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contratista_id' => 'Contratista ID',
            'campo' => 'Campo',
            'cuenta_afectada' => 'Cuenta Afectada',
            'valor' => 'Valor',
            'ano' => 'Ano',
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "efectivo_caja".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property string $ano
 * @property string $tipo
 * @property integer $tipo_caja_id
 * @property boolean $activo
 *
 * @property Contratistas $contratista
 * @property TiposCajas $tipoCaja
 */
class EfectivoCaja extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'efectivo_caja';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'ano', 'tipo', 'tipo_caja_id'], 'required'],
            [['contratista_id', 'tipo_caja_id'], 'integer'],
            [['ano'], 'safe'],
            [['tipo'], 'string'],
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
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
            'tipo' => 'Tipo',
            'tipo_caja_id' => 'Tipo Caja ID',
            'activo' => 'Activo',
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
    public function getTipoCaja()
    {
        return $this->hasOne(TiposCajas::className(), ['id' => 'tipo_caja_id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "otras_cuentas_cobrar".
 *
 * @property integer $id
 * @property integer $tipo_deudor_id
 * @property string $nombre
 * @property string $origen
 * @property string $fecha
 * @property string $garantia
 * @property string $plazo
 * @property string $ano
 * @property integer $contratista_id
 * @property boolean $activo
 *
 * @property Contratistas $contratista
 * @property TiposDeudores $tipoDeudor
 */
class OtrasCuentasCobrar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'otras_cuentas_cobrar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_deudor_id', 'contratista_id'], 'integer'],
            [['nombre', 'origen', 'fecha', 'garantia', 'plazo', 'ano', 'contratista_id'], 'required'],
            [['fecha', 'ano'], 'safe'],
            [['activo'], 'boolean'],
            [['nombre', 'origen', 'garantia', 'plazo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_deudor_id' => 'Tipo Deudor ID',
            'nombre' => 'Nombre',
            'origen' => 'Origen',
            'fecha' => 'Fecha',
            'garantia' => 'Garantia',
            'plazo' => 'Plazo',
            'ano' => 'Ano',
            'contratista_id' => 'Contratista ID',
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
    public function getTipoDeudor()
    {
        return $this->hasOne(TiposDeudores::className(), ['id' => 'tipo_deudor_id']);
    }
}

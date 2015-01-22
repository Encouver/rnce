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
 * @property string $saldo_contabilidad_c
 * @property string $saldo_contabilidad_nc
 * @property string $ano
 * @property integer $contratista_id
 *
 * @property TiposDeudores $tipoDeudor
 * @property Contratistas $contratista
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
            [['nombre', 'origen', 'fecha', 'garantia', 'plazo', 'saldo_contabilidad_c', 'saldo_contabilidad_nc', 'ano', 'contratista_id'], 'required'],
            [['fecha', 'ano'], 'safe'],
            [['saldo_contabilidad_c', 'saldo_contabilidad_nc'], 'number'],
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
            'saldo_contabilidad_c' => 'Saldo Contabilidad C',
            'saldo_contabilidad_nc' => 'Saldo Contabilidad Nc',
            'ano' => 'Ano',
            'contratista_id' => 'Contratista ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDeudor()
    {
        return $this->hasOne(TiposDeudores::className(), ['id' => 'tipo_deudor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

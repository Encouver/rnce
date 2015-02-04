<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuentas_cobrar_sprivpub".
 *
 * @property integer $id
 * @property boolean $venta
 * @property boolean $servicio
 * @property boolean $obras
 * @property string $num_contrato_factura
 * @property string $monto_contrato_f
 * @property integer $procentaje_a
 * @property integer $plazo_contrato
 * @property integer $contatista_id
 * @property string $ano
 * @property string $tipo_cuenta
 *
 * @property Contratistas $contatista
 */
class CuentasCobrarSprivpub extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas_cobrar_sprivpub';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['venta', 'servicio', 'obras'], 'boolean'],
            [['num_contrato_factura', 'monto_contrato_f', 'contatista_id'], 'required'],
            [['monto_contrato_f'], 'number'],
            [['procentaje_a', 'plazo_contrato', 'contatista_id'], 'integer'],
            [['ano'], 'safe'],
            [['tipo_cuenta'], 'string'],
            [['num_contrato_factura'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'venta' => 'Venta',
            'servicio' => 'Servicio',
            'obras' => 'Obras',
            'num_contrato_factura' => 'Num Contrato Factura',
            'monto_contrato_f' => 'Monto Contrato F',
            'procentaje_a' => 'Procentaje A',
            'plazo_contrato' => 'Plazo Contrato',
            'contatista_id' => 'Contatista ID',
            'ano' => 'Ano',
            'tipo_cuenta' => 'Tipo Cuenta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContatista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contatista_id']);
    }
}

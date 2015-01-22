<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuentas_cobrar_contrato".
 *
 * @property integer $id
 * @property string $condiciones
 * @property string $num_contrato
 * @property string $porcentaje_avance
 * @property integer $plazo_contrato
 * @property string $saldo_cont_corriente
 * @property string $saldo_cont_ncorriente
 * @property integer $contratista_id
 * @property string $ano
 * @property integer $cliente_id
 * @property boolean $contrato
 *
 * @property Clientes $cliente
 * @property Contratistas $contratista
 */
class CuentasCobrarContrato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas_cobrar_contrato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['condiciones', 'saldo_cont_corriente', 'saldo_cont_ncorriente', 'contratista_id', 'ano'], 'required'],
            [['porcentaje_avance', 'saldo_cont_corriente', 'saldo_cont_ncorriente'], 'number'],
            [['plazo_contrato', 'contratista_id', 'cliente_id'], 'integer'],
            [['ano'], 'safe'],
            [['contrato'], 'boolean'],
            [['condiciones'], 'string', 'max' => 255],
            [['num_contrato'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'condiciones' => 'Condiciones',
            'num_contrato' => 'Num Contrato',
            'porcentaje_avance' => 'Porcentaje Avance',
            'plazo_contrato' => 'Plazo Contrato',
            'saldo_cont_corriente' => 'Saldo Cont Corriente',
            'saldo_cont_ncorriente' => 'Saldo Cont Ncorriente',
            'contratista_id' => 'Contratista ID',
            'ano' => 'Ano',
            'cliente_id' => 'Cliente ID',
            'contrato' => 'Contrato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::className(), ['id' => 'cliente_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

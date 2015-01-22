<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuentas_cobro_dudoso".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $cliente_id
 * @property string $cta_cobrar30
 * @property string $cta_cobrar60
 * @property string $cta_cobrar90
 * @property string $cta_cobrar_m
 * @property string $estimacion
 * @property string $saldo_conta_corriente
 * @property string $saldo_conta_ncorriente
 * @property string $ano
 *
 * @property Clientes $cliente
 * @property Contratistas $contratista
 */
class CuentasCobroDudoso extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas_cobro_dudoso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'cliente_id', 'cta_cobrar30', 'cta_cobrar60', 'cta_cobrar90', 'cta_cobrar_m', 'estimacion', 'saldo_conta_corriente', 'saldo_conta_ncorriente', 'ano'], 'required'],
            [['contratista_id', 'cliente_id'], 'integer'],
            [['cta_cobrar30', 'cta_cobrar60', 'cta_cobrar90', 'cta_cobrar_m', 'estimacion', 'saldo_conta_corriente', 'saldo_conta_ncorriente'], 'number'],
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
            'contratista_id' => 'Contratista ID',
            'cliente_id' => 'Cliente ID',
            'cta_cobrar30' => 'Cta Cobrar30',
            'cta_cobrar60' => 'Cta Cobrar60',
            'cta_cobrar90' => 'Cta Cobrar90',
            'cta_cobrar_m' => 'Cta Cobrar M',
            'estimacion' => 'Estimacion',
            'saldo_conta_corriente' => 'Saldo Conta Corriente',
            'saldo_conta_ncorriente' => 'Saldo Conta Ncorriente',
            'ano' => 'Ano',
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

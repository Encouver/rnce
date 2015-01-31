<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "efectivo_banco".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $banco_id
 * @property string $saldo_banco
 * @property string $depos_transito
 * @property string $che_transito
 * @property string $nd_contabilizadas
 * @property string $nc_contabilizadas
 * @property string $ano
 * @property boolean $activo
 *
 * @property Bancos $banco
 * @property Contratistas $contratista
 */
class EfectivoBanco extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'efectivo_banco';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'banco_id', 'saldo_banco', 'depos_transito', 'che_transito', 'nd_contabilizadas', 'nc_contabilizadas', 'ano'], 'required'],
            [['contratista_id', 'banco_id'], 'integer'],
            [['saldo_banco', 'depos_transito', 'che_transito', 'nd_contabilizadas', 'nc_contabilizadas'], 'number'],
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
            'contratista_id' => 'Contratista ID',
            'banco_id' => 'Banco ID',
            'saldo_banco' => 'Saldo Banco',
            'depos_transito' => 'Depos Transito',
            'che_transito' => 'Che Transito',
            'nd_contabilizadas' => 'Nd Contabilizadas',
            'nc_contabilizadas' => 'Nc Contabilizadas',
            'ano' => 'Ano',
            'activo' => 'Activo',
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

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresas_relacionadas".
 *
 * @property integer $id
 * @property integer $empresa_id
 * @property integer $contratista_id
 * @property integer $otras_cuentas_pagar_id
 * @property string $participacion
 *
 * @property Contratistas $contratista
 * @property PersonasJuridicas $empresa
 */
class EmpresasRelacionadas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'empresas_relacionadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['empresa_id', 'contratista_id', 'otras_cuentas_pagar_id'], 'required'],
            [['empresa_id', 'contratista_id', 'otras_cuentas_pagar_id'], 'integer'],
            [['participacion'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'empresa_id' => 'Empresa ID',
            'contratista_id' => 'Contratista ID',
            'otras_cuentas_pagar_id' => 'Otras Cuentas Pagar ID',
            'participacion' => 'Participacion',
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
    public function getEmpresa()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'empresa_id']);
    }
}

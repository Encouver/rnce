<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.i4_costos_personal_objeto".
 *
 * @property integer $id
 * @property integer $objeto_empresa_id
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasI4CostosPersonal[] $cuentasI4CostosPersonals
 * @property CuentasSysConceptos $objetoEmpresa
 * @property Contratistas $contratista
 */
class CuentasI4CostosPersonalObjeto extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.i4_costos_personal_objeto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['objeto_empresa_id', 'contratista_id', 'anho'], 'required'],
            [['objeto_empresa_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['anho'], 'string', 'max' => 100],
            [['objeto_empresa_id', 'contratista_id', 'anho'], 'unique', 'targetAttribute' => ['objeto_empresa_id', 'contratista_id', 'anho'], 'message' => 'The combination of Objeto Empresa ID, Contratista ID and Anho has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'objeto_empresa_id' => Yii::t('app', 'Objeto Empresa ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasI4CostosPersonals()
    {
        return $this->hasMany(CuentasI4CostosPersonal::className(), ['cp_objeto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetoEmpresa()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'objeto_empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.bb2_garantias".
 *
 * @property integer $id
 * @property integer $classname_id
 * @property string $tipo
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property CuentasBb2OtrasCuentasPorPagar[] $cuentasBb2OtrasCuentasPorPagars
 */
class CuentasBb2Garantias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.bb2_garantias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['classname_id', 'contratista_id', 'anho'], 'required'],
            [['classname_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'classname_id' => Yii::t('app', 'Classname ID'),
            'tipo' => Yii::t('app', 'Tipo'),
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
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasBb2OtrasCuentasPorPagars()
    {
        return $this->hasMany(CuentasBb2OtrasCuentasPorPagar::className(), ['garantia' => 'id']);
    }
}

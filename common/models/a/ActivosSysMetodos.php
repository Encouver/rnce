<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.sys_metodos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $descripcion
 * @property integer $modelo_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosSysModelos $modelo
 * @property CuentasEInversionesInfoAdicional[] $cuentasEInversionesInfoAdicionals
 */
class ActivosSysMetodos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_metodos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'modelo_id'], 'required'],
            [['modelo_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre', 'descripcion'], 'string', 'max' => 255],
            [['nombre'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'modelo_id' => Yii::t('app', 'Modelo ID'),
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
    public function getModelo()
    {
        return $this->hasOne(ActivosSysModelos::className(), ['id' => 'modelo_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuentasEInversionesInfoAdicionals()
    {
        return $this->hasMany(CuentasEInversionesInfoAdicional::className(), ['sys_metodo_id' => 'id']);
    }
}

<?php

namespace common\models\public;

use Yii;

/**
 * This is the model class for table "public.sys_bancos".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $rif
 * @property string $codigo_sudeban
 * @property string $codigo_swift
 * @property integer $sys_pais_id
 * @property string $tipo_nacionalidad
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property SysPaises $sysPais
 * @property BancosContratistas[] $bancosContratistas
 * @property CapitalesEfectivos[] $capitalesEfectivos
 */
class SysBancos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.sys_bancos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'codigo_sudeban', 'codigo_swift', 'sys_pais_id', 'tipo_nacionalidad'], 'required'],
            [['sys_pais_id'], 'integer'],
            [['tipo_nacionalidad'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre'], 'string', 'max' => 255],
            [['rif'], 'string', 'max' => 25],
            [['codigo_sudeban', 'codigo_swift'], 'string', 'max' => 10],
            [['rif'], 'unique'],
            [['codigo_sudeban'], 'unique']
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
            'rif' => Yii::t('app', 'Rif'),
            'codigo_sudeban' => Yii::t('app', 'Codigo Sudeban'),
            'codigo_swift' => Yii::t('app', 'Codigo Swift'),
            'sys_pais_id' => Yii::t('app', 'Sys Pais ID'),
            'tipo_nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysPais()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'sys_pais_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBancosContratistas()
    {
        return $this->hasMany(BancosContratistas::className(), ['banco_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitalesEfectivos()
    {
        return $this->hasMany(CapitalesEfectivos::className(), ['sys_banco_id' => 'id']);
    }
}

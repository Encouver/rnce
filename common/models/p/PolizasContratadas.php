<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.polizas_contratadas".
 *
 * @property integer $id
 * @property integer $sys_pais_id
 * @property string $tipo_nacionalidad
 * @property integer $contratista_id
 * @property string $numero_identificacion
 * @property string $numero_contrato
 * @property string $fecha_suscripcion
 * @property string $fecha_inicio
 * @property string $fecha_finalizacion
 * @property integer $duracion
 * @property string $tipo_poliza
 * @property integer $bien_asegurado
 * @property string $monto_asegurado
 * @property string $monto_contrato
 * @property integer $aseguradora_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Contratistas $contratista
 * @property PersonasJuridicas $aseguradora
 * @property SysPaises $sysPais
 */
class PolizasContratadas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.polizas_contratadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_pais_id', 'tipo_nacionalidad', 'contratista_id', 'numero_contrato', 'fecha_suscripcion', 'fecha_inicio', 'fecha_finalizacion', 'duracion', 'tipo_poliza', 'bien_asegurado', 'monto_asegurado', 'aseguradora_id'], 'required'],
            [['sys_pais_id', 'contratista_id', 'duracion', 'bien_asegurado', 'aseguradora_id'], 'integer'],
            [['tipo_nacionalidad', 'tipo_poliza'], 'string'],
            [['fecha_suscripcion', 'fecha_inicio', 'fecha_finalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['monto_asegurado', 'monto_contrato'], 'number'],
            [['sys_status'], 'boolean'],
            [['numero_identificacion', 'numero_contrato'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_pais_id' => Yii::t('app', 'Sys Pais ID'),
            'tipo_nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'numero_contrato' => Yii::t('app', 'Numero Contrato'),
            'fecha_suscripcion' => Yii::t('app', 'Fecha Suscripcion'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_finalizacion' => Yii::t('app', 'Fecha Finalizacion'),
            'duracion' => Yii::t('app', 'Duracion'),
            'tipo_poliza' => Yii::t('app', 'Tipo Poliza'),
            'bien_asegurado' => Yii::t('app', 'Bien Asegurado'),
            'monto_asegurado' => Yii::t('app', 'Monto Asegurado'),
            'monto_contrato' => Yii::t('app', 'Monto Contrato'),
            'aseguradora_id' => Yii::t('app', 'Aseguradora ID'),
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
    public function getAseguradora()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'aseguradora_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysPais()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'sys_pais_id']);
    }
}

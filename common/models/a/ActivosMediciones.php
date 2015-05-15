<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.mediciones".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property boolean $medicion_activo
 * @property integer $sys_metodo_medicion_id
 * @property boolean $aplica_deterioro
 * @property boolean $vinculado_proceso_productivo
 * @property boolean $vinculado_proceso_ventas
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $directo
 *
 * @property ActivosBienes $bien
 * @property ActivosSysMetodosMedicion $sysMetodoMedicion
 */
class ActivosMediciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.mediciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'sys_metodo_medicion_id'], 'required'],
            [['bien_id', 'sys_metodo_medicion_id'], 'integer'],
            [['medicion_activo', 'aplica_deterioro', 'vinculado_proceso_productivo', 'vinculado_proceso_ventas', 'sys_status', 'directo'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'medicion_activo' => Yii::t('app', 'Medicion Activo'),
            'sys_metodo_medicion_id' => Yii::t('app', 'Sys Metodo Medicion ID'),
            'aplica_deterioro' => Yii::t('app', 'Aplica Deterioro'),
            'vinculado_proceso_productivo' => Yii::t('app', 'Vinculado Proceso Productivo'),
            'vinculado_proceso_ventas' => Yii::t('app', 'Vinculado Proceso Ventas'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'directo' => Yii::t('app', 'Directo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysMetodoMedicion()
    {
        return $this->hasOne(ActivosSysMetodosMedicion::className(), ['id' => 'sys_metodo_medicion_id']);
    }
}

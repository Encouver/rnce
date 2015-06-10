<?php

namespace common\models\c;

use Yii;

/**
 * This is the model class for table "cuentas.i4_costos_personal".
 *
 * @property integer $id
 * @property string $monto_mano_directa
 * @property integer $metodo_inflacion_directa
 * @property string $desde_directa
 * @property string $hasta_directa
 * @property string $mdo_ajustado_directa
 * @property string $monto_mano_indirecta
 * @property integer $metodo_inflacion_indirecta
 * @property string $desde_indirecta
 * @property string $hasta_indirecta
 * @property string $mdo_ajustado_indirecta
 * @property integer $concepto_id
 * @property integer $cp_objeto_id
 * @property string $especifique
 * @property integer $contratista_id
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property CuentasI4CostosPersonalObjeto $cpObjeto
 * @property CuentasSysConceptos $concepto
 * @property Contratistas $contratista
 */
class CuentasI4CostosPersonal extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuentas.i4_costos_personal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto_mano_directa', 'metodo_inflacion_directa', 'desde_directa', 'hasta_directa', 'mdo_ajustado_directa', 'monto_mano_indirecta', 'metodo_inflacion_indirecta', 'desde_indirecta', 'hasta_indirecta', 'mdo_ajustado_indirecta', 'concepto_id', 'cp_objeto_id', 'contratista_id', 'anho'], 'required'],
            [['monto_mano_directa', 'mdo_ajustado_directa', 'monto_mano_indirecta', 'mdo_ajustado_indirecta'], 'number'],
            [['metodo_inflacion_directa', 'metodo_inflacion_indirecta', 'concepto_id', 'cp_objeto_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['desde_directa', 'hasta_directa', 'desde_indirecta', 'hasta_indirecta', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['especifique'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100],
            [['contratista_id', 'anho', 'cp_objeto_id'], 'unique', 'targetAttribute' => ['contratista_id', 'anho', 'cp_objeto_id'], 'message' => 'The combination of Cp Objeto ID, Contratista ID and Anho has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'monto_mano_directa' => Yii::t('app', 'Monto Mano Directa'),
            'metodo_inflacion_directa' => Yii::t('app', 'Metodo Inflacion Directa'),
            'desde_directa' => Yii::t('app', 'Desde Directa'),
            'hasta_directa' => Yii::t('app', 'Hasta Directa'),
            'mdo_ajustado_directa' => Yii::t('app', 'Mdo Ajustado Directa'),
            'monto_mano_indirecta' => Yii::t('app', 'Monto Mano Indirecta'),
            'metodo_inflacion_indirecta' => Yii::t('app', 'Metodo Inflacion Indirecta'),
            'desde_indirecta' => Yii::t('app', 'Desde Indirecta'),
            'hasta_indirecta' => Yii::t('app', 'Hasta Indirecta'),
            'mdo_ajustado_indirecta' => Yii::t('app', 'Mdo Ajustado Indirecta'),
            'concepto_id' => Yii::t('app', 'Concepto ID'),
            'cp_objeto_id' => Yii::t('app', 'Cp Objeto ID'),
            'especifique' => Yii::t('app', 'Especifique'),
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
    public function getCpObjeto()
    {
        return $this->hasOne(CuentasI4CostosPersonalObjeto::className(), ['id' => 'cp_objeto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConcepto()
    {
        return $this->hasOne(CuentasSysConceptos::className(), ['id' => 'concepto_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
}

<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.limitaciones_capitales".
 *
 * @property integer $id
 * @property boolean $afecta
 * @property string $fecha_cierre
 * @property string $capital_social
 * @property string $total_patrimonio
 * @property double $porcentaje_descapitalizacion
 * @property boolean $supuesto
 * @property string $monto_perdida
 * @property string $fecha_limitacion
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $capital_social_actualizado
 * @property integer $certificacion_aporte_id
 * @property boolean $no_afecta
 * @property boolean $reintegro
 * @property string $capital_legal
 * @property string $saldo_perdida
 *
 * @property ActasConstitutivas $actaConstitutiva
 * @property CertificacionesAportes $certificacionAporte
 * @property LimitacionesCapitalesAfectados[] $limitacionesCapitalesAfectados
 */
class LimitacionesCapitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.limitaciones_capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['afecta', 'fecha_cierre', 'capital_social', 'total_patrimonio', 'porcentaje_descapitalizacion', 'supuesto', 'monto_perdida', 'fecha_limitacion', 'acta_constitutiva_id', 'capital_social_actualizado', 'certificacion_aporte_id', 'no_afecta', 'reintegro'], 'required'],
            [['afecta', 'supuesto', 'sys_status', 'no_afecta', 'reintegro'], 'boolean'],
            [['fecha_cierre', 'fecha_limitacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['capital_social', 'total_patrimonio', 'porcentaje_descapitalizacion', 'monto_perdida', 'capital_social_actualizado', 'capital_legal', 'saldo_perdida'], 'number'],
            [['acta_constitutiva_id', 'certificacion_aporte_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'afecta' => Yii::t('app', 'Afecta'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'capital_social' => Yii::t('app', 'Capital Social'),
            'total_patrimonio' => Yii::t('app', 'Total Patrimonio'),
            'porcentaje_descapitalizacion' => Yii::t('app', 'Porcentaje Descapitalizacion'),
            'supuesto' => Yii::t('app', 'Supuesto'),
            'monto_perdida' => Yii::t('app', 'Monto Perdida'),
            'fecha_limitacion' => Yii::t('app', 'Fecha Limitacion'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'capital_social_actualizado' => Yii::t('app', 'Capital Social Actualizado'),
            'certificacion_aporte_id' => Yii::t('app', 'Certificacion Aporte ID'),
            'no_afecta' => Yii::t('app', 'No Afecta'),
            'reintegro' => Yii::t('app', 'Reintegro'),
            'capital_legal' => Yii::t('app', 'Capital Legal'),
            'saldo_perdida' => Yii::t('app', 'Saldo Perdida'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificacionAporte()
    {
        return $this->hasOne(CertificacionesAportes::className(), ['id' => 'certificacion_aporte_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitalesAfectados()
    {
        return $this->hasMany(LimitacionesCapitalesAfectados::className(), ['limitacion_capital_id' => 'id']);
    }
}

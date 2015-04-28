<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.certificados_disminuidos".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor_asociacion
 * @property string $valor_aportacion
 * @property string $valor_rotativo
 * @property string $valor_inversion
 * @property integer $numero_asociacion
 * @property integer $numero_aportacion
 * @property integer $numero_rotativo
 * @property integer $numero_inversion
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $valor_asociacion_actual
 * @property string $valor_aportacion_actual
 * @property string $valor_rotativo_actual
 * @property string $valor_inversion_actual
 * @property integer $numero_asoacion_actual
 * @property integer $numero_aportacion_actual
 * @property string $numero_rotativo_actual
 * @property string $numero_inversion_actual
 * @property string $capital_social
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class CertificadosDisminuidos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.certificados_disminuidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'acta_constitutiva_id', 'capital_social'], 'required'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor_asociacion', 'valor_aportacion', 'valor_rotativo', 'valor_inversion', 'valor_asociacion_actual', 'valor_aportacion_actual', 'valor_rotativo_actual', 'valor_inversion_actual', 'numero_rotativo_actual', 'numero_inversion_actual', 'capital_social'], 'number'],
            [['numero_asociacion', 'numero_aportacion', 'numero_rotativo', 'numero_inversion', 'acta_constitutiva_id', 'numero_asoacion_actual', 'numero_aportacion_actual'], 'integer'],
            [['sys_status'], 'boolean'],
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
            'justificacion' => Yii::t('app', 'Justificacion'),
            'tipo_disminucion' => Yii::t('app', 'Tipo Disminucion'),
            'valor_asociacion' => Yii::t('app', 'Valor Asociacion'),
            'valor_aportacion' => Yii::t('app', 'Valor Aportacion'),
            'valor_rotativo' => Yii::t('app', 'Valor Rotativo'),
            'valor_inversion' => Yii::t('app', 'Valor Inversion'),
            'numero_asociacion' => Yii::t('app', 'Numero Asociacion'),
            'numero_aportacion' => Yii::t('app', 'Numero Aportacion'),
            'numero_rotativo' => Yii::t('app', 'Numero Rotativo'),
            'numero_inversion' => Yii::t('app', 'Numero Inversion'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'valor_asociacion_actual' => Yii::t('app', 'Valor Asociacion Actual'),
            'valor_aportacion_actual' => Yii::t('app', 'Valor Aportacion Actual'),
            'valor_rotativo_actual' => Yii::t('app', 'Valor Rotativo Actual'),
            'valor_inversion_actual' => Yii::t('app', 'Valor Inversion Actual'),
            'numero_asoacion_actual' => Yii::t('app', 'Numero Asoacion Actual'),
            'numero_aportacion_actual' => Yii::t('app', 'Numero Aportacion Actual'),
            'numero_rotativo_actual' => Yii::t('app', 'Numero Rotativo Actual'),
            'numero_inversion_actual' => Yii::t('app', 'Numero Inversion Actual'),
            'capital_social' => Yii::t('app', 'Capital Social'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }
}

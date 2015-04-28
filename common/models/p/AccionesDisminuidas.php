<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.acciones_disminuidas".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $valor_comun_actual
 * @property string $valor_preferencial_actual
 * @property integer $numero_comun_actual
 * @property integer $numero_preferencial_actual
 * @property string $capital_social
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class AccionesDisminuidas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.acciones_disminuidas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'acta_constitutiva_id', 'capital_social'], 'required'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor_comun', 'valor_preferencial', 'valor_comun_actual', 'valor_preferencial_actual', 'capital_social'], 'number'],
            [['numero_comun', 'numero_preferencial', 'acta_constitutiva_id', 'numero_comun_actual', 'numero_preferencial_actual'], 'integer'],
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
            'valor_comun' => Yii::t('app', 'Valor Comun'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'numero_comun' => Yii::t('app', 'Numero Comun'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'valor_comun_actual' => Yii::t('app', 'Valor Comun Actual'),
            'valor_preferencial_actual' => Yii::t('app', 'Valor Preferencial Actual'),
            'numero_comun_actual' => Yii::t('app', 'Numero Comun Actual'),
            'numero_preferencial_actual' => Yii::t('app', 'Numero Preferencial Actual'),
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

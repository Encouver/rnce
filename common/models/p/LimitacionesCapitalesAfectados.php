<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.limitaciones_capitales_afectados".
 *
 * @property integer $id
 * @property integer $limitacion_capital_id
 * @property string $capital_legal
 * @property string $valor_accion
 * @property integer $total_accion
 * @property string $valor_accion_actual
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $capital_legal_actual
 * @property string $total_capital
 *
 * @property ActasConstitutivas $actaConstitutiva
 * @property LimitacionesCapitales $limitacionCapital
 */
class LimitacionesCapitalesAfectados extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.limitaciones_capitales_afectados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['limitacion_capital_id', 'capital_legal', 'valor_accion', 'total_accion', 'valor_accion_actual', 'acta_constitutiva_id', 'capital_legal_actual', 'total_capital'], 'required'],
            [['limitacion_capital_id', 'total_accion', 'acta_constitutiva_id'], 'integer'],
            [['capital_legal', 'valor_accion', 'valor_accion_actual', 'capital_legal_actual', 'total_capital'], 'number'],
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
            'limitacion_capital_id' => Yii::t('app', 'Limitacion Capital ID'),
            'capital_legal' => Yii::t('app', 'Capital Legal'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'total_accion' => Yii::t('app', 'Total Accion'),
            'valor_accion_actual' => Yii::t('app', 'Valor Accion Actual'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'capital_legal_actual' => Yii::t('app', 'Capital Legal Actual'),
            'total_capital' => Yii::t('app', 'Total Capital'),
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
    public function getLimitacionCapital()
    {
        return $this->hasOne(LimitacionesCapitales::className(), ['id' => 'limitacion_capital_id']);
    }
}

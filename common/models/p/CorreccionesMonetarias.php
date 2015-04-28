<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.correcciones_monetarias".
 *
 * @property integer $id
 * @property string $nuevo_valor
 * @property string $fecha_aumento
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $valor_accion
 * @property string $variacion_valor
 * @property integer $total_accion
 * @property string $monto_capital_legal
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class CorreccionesMonetarias extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.correcciones_monetarias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nuevo_valor', 'fecha_aumento', 'acta_constitutiva_id', 'valor_accion', 'variacion_valor', 'total_accion', 'monto_capital_legal'], 'required'],
            [['nuevo_valor', 'valor_accion', 'variacion_valor', 'monto_capital_legal'], 'number'],
            [['fecha_aumento', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['acta_constitutiva_id', 'total_accion'], 'integer'],
            [['sys_status'], 'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nuevo_valor' => Yii::t('app', 'Nuevo Valor'),
            'fecha_aumento' => Yii::t('app', 'Fecha Aumento'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'variacion_valor' => Yii::t('app', 'Variacion Valor'),
            'total_accion' => Yii::t('app', 'Total Accion'),
            'monto_capital_legal' => Yii::t('app', 'Monto Capital Legal'),
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

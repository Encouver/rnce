<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.suplementarios_disminuidos".
 *
 * @property integer $id
 * @property string $justificacion
 * @property string $tipo_disminucion
 * @property string $valor
 * @property integer $numero
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $valor_actual
 * @property integer $numero_actual
 * @property string $capital_social
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class SuplementariosDisminuidos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.suplementarios_disminuidos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['justificacion', 'tipo_disminucion', 'acta_constitutiva_id', 'capital_social'], 'required'],
            [['justificacion', 'tipo_disminucion'], 'string'],
            [['valor', 'valor_actual', 'capital_social'], 'number'],
            [['numero', 'acta_constitutiva_id', 'numero_actual'], 'integer'],
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
            'valor' => Yii::t('app', 'Valor'),
            'numero' => Yii::t('app', 'Numero'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'valor_actual' => Yii::t('app', 'Valor Actual'),
            'numero_actual' => Yii::t('app', 'Numero Actual'),
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

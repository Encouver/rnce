<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.aumentos_capitales".
 *
 * @property integer $id
 * @property integer $total_accion
 * @property string $valor_accion
 * @property string $total_capital
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class AumentosCapitales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.aumentos_capitales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_accion', 'valor_accion', 'total_capital', 'acta_constitutiva_id'], 'required'],
            [['total_accion', 'acta_constitutiva_id'], 'integer'],
            [['valor_accion', 'total_capital'], 'number'],
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
            'total_accion' => Yii::t('app', 'Total Accion'),
            'valor_accion' => Yii::t('app', 'Valor Accion'),
            'total_capital' => Yii::t('app', 'Total Capital'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
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

<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.decretos_div_excedentes".
 *
 * @property integer $id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $acta_constitutiva_id
 * @property string $fecha_cierre
 * @property string $utilidad_acumulada
 * @property string $utilidad_decretada
 *
 * @property PagosAccionistasDecretos[] $pagosAccionistasDecretos
 * @property ActasConstitutivas $actaConstitutiva
 */
class DecretosDivExcedentes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.decretos_div_excedentes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_cierre'], 'safe'],
            [['acta_constitutiva_id', 'fecha_cierre', 'utilidad_acumulada', 'utilidad_decretada'], 'required'],
            [['acta_constitutiva_id'], 'integer'],
            [['utilidad_acumulada', 'utilidad_decretada'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'fecha_cierre' => Yii::t('app', 'Fecha Cierre'),
            'utilidad_acumulada' => Yii::t('app', 'Utilidad Acumulada'),
            'utilidad_decretada' => Yii::t('app', 'Utilidad Decretada'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagosAccionistasDecretos()
    {
        return $this->hasMany(PagosAccionistasDecretos::className(), ['decreto_div_excedente_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }
}

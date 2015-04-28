<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.modificaciones_balances".
 *
 * @property integer $id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $acta_constitutiva_id
 * @property string $fecha_cierre
 * @property boolean $aprobado
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class ModificacionesBalances extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.modificaciones_balances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sys_status', 'aprobado'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'fecha_cierre'], 'safe'],
            [['acta_constitutiva_id', 'fecha_cierre', 'aprobado'], 'required'],
            [['acta_constitutiva_id'], 'integer']
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
            'aprobado' => Yii::t('app', 'Aprobado'),
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

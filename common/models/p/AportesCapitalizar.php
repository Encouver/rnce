<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.aportes_capitalizar".
 *
 * @property integer $id
 * @property string $monto_aporte
 * @property string $fecha_capitalizacion
 * @property integer $acta_constitutiva_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class AportesCapitalizar extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.aportes_capitalizar';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['monto_aporte', 'fecha_capitalizacion', 'acta_constitutiva_id'], 'required'],
            [['monto_aporte'], 'number'],
            [['fecha_capitalizacion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['acta_constitutiva_id'], 'integer'],
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
            'monto_aporte' => Yii::t('app', 'Monto Aporte'),
            'fecha_capitalizacion' => Yii::t('app', 'Fecha Capitalizacion'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
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

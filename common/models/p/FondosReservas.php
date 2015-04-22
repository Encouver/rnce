<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.fondos_reservas".
 *
 * @property integer $id
 * @property integer $acta_constitutiva_id
 * @property string $nombre_fondo
 * @property double $porcentaje
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class FondosReservas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.fondos_reservas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['acta_constitutiva_id', 'nombre_fondo', 'porcentaje'], 'required'],
            [['acta_constitutiva_id'], 'integer'],
            [['porcentaje'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nombre_fondo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'nombre_fondo' => Yii::t('app', 'Nombre Fondo'),
            'porcentaje' => Yii::t('app', 'Porcentaje'),
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

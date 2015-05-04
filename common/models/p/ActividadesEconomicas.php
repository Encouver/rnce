<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.actividades_economicas".
 *
 * @property integer $id
 * @property integer $ppal_caev_id
 * @property integer $comp1_caev_id
 * @property integer $comp2_caev_id
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $ppal_experiencia
 * @property integer $comp1_experiencia
 * @property integer $comp2_experiencia
 *
 * @property SysCaev $comp1Caev
 * @property SysCaev $comp2Caev
 * @property Contratistas $contratista
 * @property SysCaev $ppalCaev
 */
class ActividadesEconomicas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.actividades_economicas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contratista_id', 'ppal_experiencia', 'comp1_experiencia'], 'required'],
            [['ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contratista_id', 'ppal_experiencia', 'comp1_experiencia', 'comp2_experiencia'], 'integer'],
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
            'ppal_caev_id' => Yii::t('app', 'Actividad economica principal'),
            'comp1_caev_id' => Yii::t('app', 'Actividad economica complementaria 1'),
            'comp2_caev_id' => Yii::t('app', 'Actividad economica complementaria 2'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'ppal_experiencia' => Yii::t('app', 'Experiencia'),
            'comp1_experiencia' => Yii::t('app', 'Experiencia'),
            'comp2_experiencia' => Yii::t('app', 'Experiencia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp1Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp1_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComp2Caev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'comp2_caev_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPpalCaev()
    {
        return $this->hasOne(SysCaev::className(), ['id' => 'ppal_caev_id']);
    }
}

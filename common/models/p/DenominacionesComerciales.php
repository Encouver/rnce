<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.denominaciones_comerciales".
 *
 * @property integer $id
 * @property string $codigo_situr
 * @property string $cooperativa_capital
 * @property string $cooperativa_distribuicion
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_denominacion
 * @property string $tipo_subdenominacion
 *
 * @property Contratistas $contratista
 * @property ActasConstitutivas[] $actasConstitutivas
 */
class DenominacionesComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.denominaciones_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cooperativa_capital', 'cooperativa_distribuicion', 'tipo_denominacion', 'tipo_subdenominacion'], 'string'],
            [['contratista_id', 'tipo_denominacion'], 'required'],
            [['contratista_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['codigo_situr'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo_situr' => Yii::t('app', 'Codigo Situr'),
            'cooperativa_capital' => Yii::t('app', 'Cooperativa Capital'),
            'cooperativa_distribuicion' => Yii::t('app', 'Cooperativa Distribuicion'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_denominacion' => Yii::t('app', 'Tipo Denominacion'),
            'tipo_subdenominacion' => Yii::t('app', 'Tipo Subdenominacion'),
        ];
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
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['denominacion_comercial_id' => 'id']);
    }
    
    

}

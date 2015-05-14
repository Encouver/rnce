<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.datos_importaciones".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $num_guia_nac
 * @property string $costo_adquisicion
 * @property string $gastos_mon_extranjera
 * @property integer $sys_divisa_id
 * @property string $tasa_cambio
 * @property string $gastos_imp_nacional
 * @property string $otros_costros_imp_instalacion
 * @property string $total_costo_adquisicion
 * @property integer $pais_origen_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property SysDivisas $sysDivisa
 * @property SysPaises $paisOrigen
 */
class ActivosDatosImportaciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.datos_importaciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'num_guia_nac', 'costo_adquisicion', 'gastos_mon_extranjera', 'sys_divisa_id', 'tasa_cambio', 'gastos_imp_nacional', 'otros_costros_imp_instalacion', 'total_costo_adquisicion', 'pais_origen_id'], 'required'],
            [['bien_id', 'sys_divisa_id', 'pais_origen_id'], 'integer'],
            [['costo_adquisicion', 'gastos_mon_extranjera', 'tasa_cambio', 'gastos_imp_nacional', 'otros_costros_imp_instalacion', 'total_costo_adquisicion'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_guia_nac'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'num_guia_nac' => Yii::t('app', 'Num Guia Nac'),
            'costo_adquisicion' => Yii::t('app', 'Costo Adquisicion'),
            'gastos_mon_extranjera' => Yii::t('app', 'Gastos Mon Extranjera'),
            'sys_divisa_id' => Yii::t('app', 'Sys Divisa ID'),
            'tasa_cambio' => Yii::t('app', 'Tasa Cambio'),
            'gastos_imp_nacional' => Yii::t('app', 'Gastos Imp Nacional'),
            'otros_costros_imp_instalacion' => Yii::t('app', 'Otros Costros Imp Instalacion'),
            'total_costo_adquisicion' => Yii::t('app', 'Total Costo Adquisicion'),
            'pais_origen_id' => Yii::t('app', 'Pais Origen ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(ActivosBienes::className(), ['id' => 'bien_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysDivisa()
    {
        return $this->hasOne(SysDivisas::className(), ['id' => 'sys_divisa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaisOrigen()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'pais_origen_id']);
    }
}

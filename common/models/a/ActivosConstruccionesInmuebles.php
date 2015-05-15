<?php

namespace common\models\a;

use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "activos.construcciones_inmuebles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $area_construccion
 * @property string $porcentaje_ejecucion
 * @property string $monto_ejecutado
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 */
class ActivosConstruccionesInmuebles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.construcciones_inmuebles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'area_construccion', 'porcentaje_ejecucion', 'monto_ejecutado'], 'required'],
            [['bien_id'], 'integer'],
            [['porcentaje_ejecucion', 'monto_ejecutado'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['area_construccion'], 'string', 'max' => 255]
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
            'area_construccion' => Yii::t('app', 'Area Construccion'),
            'porcentaje_ejecucion' => Yii::t('app', 'Porcentaje Ejecucion'),
            'monto_ejecutado' => Yii::t('app', 'Monto Ejecutado'),
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

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'area_construccion'=>['type'=>Form::INPUT_TEXT,],
            'porcentaje_ejecucion'=>['type'=>Form::INPUT_TEXT,],
            'monto_ejecutado'=>['type'=>Form::INPUT_TEXT,],

        ];
    }
}

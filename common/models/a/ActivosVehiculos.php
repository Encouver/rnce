<?php

namespace common\models\a;

use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "activos.vehiculos".
 *
 * @property integer $id
 * @property integer $mueble_id
 * @property integer $anho_vehiculo
 * @property integer $uso
 * @property string $num_certificado
 * @property string $placa
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosMuebles $mueble
 */
class ActivosVehiculos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.vehiculos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mueble_id', 'anho_vehiculo', 'uso', 'num_certificado', 'placa'], 'required'],
            [['mueble_id', 'anho_vehiculo', 'uso', 'creado_por', 'actualizado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_certificado'], 'string', 'max' => 255],
            [['placa'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'mueble_id' => Yii::t('app', 'Mueble ID'),
            'anho_vehiculo' => Yii::t('app', 'Año del vehiculo'),
            'uso' => Yii::t('app', 'Uso'),
            'num_certificado' => Yii::t('app', 'Num Certificado'),
            'placa' => Yii::t('app', 'Placa'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    public function getFormAttribs() {
        $attributes = [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'anho_vehiculo' => ['type'=>Form::INPUT_TEXT,],
            'uso' => ['type'=>Form::INPUT_TEXT,],
            'num_certificado' => ['type'=>Form::INPUT_TEXT,],
            'placa' => ['type'=>Form::INPUT_TEXT,],

        ];


        return $attributes;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMueble()
    {
        return $this->hasOne(ActivosMuebles::className(), ['id' => 'mueble_id']);
    }
}

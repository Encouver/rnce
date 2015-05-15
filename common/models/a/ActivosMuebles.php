<?php

namespace common\models\a;

use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "activos.muebles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $marca
 * @property string $modelo
 * @property string $serial
 * @property integer $cantidad
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 * @property ActivosVehiculos[] $activosVehiculos
 */
class ActivosMuebles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.muebles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'marca', 'modelo', 'serial', 'cantidad'], 'required'],
            [['bien_id', 'cantidad'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['marca', 'modelo', 'serial'], 'string', 'max' => 255]
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
            'marca' => Yii::t('app', 'Marca'),
            'modelo' => Yii::t('app', 'Modelo'),
            'serial' => Yii::t('app', 'Serial'),
            'cantidad' => Yii::t('app', 'Cantidad'),
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
    public function getActivosVehiculos()
    {
        return $this->hasMany(ActivosVehiculos::className(), ['mueble_id' => 'id']);
    }

    public function getFormAttribs() {
        return [
            // primary key column
            'id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
            ],
            'marca'=>['type'=>Form::INPUT_TEXT,],
            'modelo'=>['type'=>Form::INPUT_TEXT,],
            'serial'=>['type'=>Form::INPUT_TEXT,],
            'cantidad'=>['type'=>Form::INPUT_TEXT,],

        ];
    }
}

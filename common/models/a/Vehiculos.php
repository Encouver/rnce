<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.vehiculos".
 *
 * @property integer $id
 * @property integer $mueble_id
 * @property integer $anho
 * @property integer $uso
 * @property string $num_certificado
 * @property string $placa
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Muebles $mueble
 */
class Vehiculos extends \common\components\BaseActiveRecord
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
            [['mueble_id', 'anho', 'uso', 'num_certificado', 'placa'], 'required'],
            [['mueble_id', 'anho', 'uso'], 'integer'],
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
            'anho' => Yii::t('app', 'Anho'),
            'uso' => Yii::t('app', 'Uso'),
            'num_certificado' => Yii::t('app', 'Num Certificado'),
            'placa' => Yii::t('app', 'Placa'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMueble()
    {
        return $this->hasOne(Muebles::className(), ['id' => 'mueble_id']);
    }
}

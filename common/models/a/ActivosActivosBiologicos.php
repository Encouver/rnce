<?php

namespace common\models\a;

use kartik\builder\Form;
use Yii;

/**
 * This is the model class for table "activos.activos_biologicos".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property integer $cantidad
 * @property boolean $certificado
 * @property string $num_certificado
 * @property string $detalles
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosBienes $bien
 */
class ActivosActivosBiologicos extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.activos_biologicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'cantidad', 'detalles'], 'required'],
            [['bien_id', 'cantidad', 'creado_por', 'actualizado_por'], 'integer'],
            [['certificado', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_certificado', 'detalles'], 'string', 'max' => 255],
            [['bien_id'], 'unique']
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
            'cantidad' => Yii::t('app', 'Cantidad'),
            'certificado' => Yii::t('app', 'Certificado'),
            'num_certificado' => Yii::t('app', 'Num Certificado'),
            'detalles' => Yii::t('app', 'Detalles'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
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
            'cantidad'=>['type'=>Form::INPUT_TEXT,],
            'certificado'=>['type'=>Form::INPUT_TEXT,],
            'num_certificado'=>['type'=>Form::INPUT_TEXT,],
            'detalles'=>['type'=>Form::INPUT_TEXT,],

        ];
    }
}

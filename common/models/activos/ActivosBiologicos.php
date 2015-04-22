<?php

namespace common\models\activos;

use Yii;

/**
 * This is the model class for table "activos.activos_biologicos".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property integer $catidad
 * @property boolean $certificado
 * @property string $num_certificado
 * @property string $detalles
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Bienes $bien
 */
class ActivosBiologicos extends \common\components\BaseActiveRecord
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
            [['bien_id', 'catidad', 'detalles'], 'required'],
            [['bien_id', 'catidad'], 'integer'],
            [['certificado', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['num_certificado', 'detalles'], 'string', 'max' => 255]
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
            'catidad' => Yii::t('app', 'Catidad'),
            'certificado' => Yii::t('app', 'Certificado'),
            'num_certificado' => Yii::t('app', 'Num Certificado'),
            'detalles' => Yii::t('app', 'Detalles'),
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
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }
}

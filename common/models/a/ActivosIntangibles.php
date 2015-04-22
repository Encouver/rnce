<?php

namespace common\models\a;

use Yii;

/**
 * This is the model class for table "activos.activos_intangibles".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $certificado_registro
 * @property string $fecha_registro
 * @property string $vigencia
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Licencias[] $licencias
 * @property Bienes $bien
 */
class ActivosIntangibles extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.activos_intangibles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'vigencia'], 'required'],
            [['bien_id'], 'integer'],
            [['fecha_registro', 'vigencia', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['certificado_registro'], 'string', 'max' => 255]
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
            'certificado_registro' => Yii::t('app', 'Certificado Registro'),
            'fecha_registro' => Yii::t('app', 'Fecha Registro'),
            'vigencia' => Yii::t('app', 'Vigencia'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLicencias()
    {
        return $this->hasMany(Licencias::className(), ['activo_intangible_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }
}

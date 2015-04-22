<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.certificaciones_aportes".
 *
 * @property integer $id
 * @property integer $capital_id
 * @property integer $persona_natural_id
 * @property string $colegiatura
 * @property string $tipo_profesion
 * @property string $fecha_informe
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Capitales $capital
 */
class CertificacionesAportes extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.certificaciones_aportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['capital_id', 'tipo_profesion', 'fecha_informe'], 'required'],
            [['capital_id', 'persona_natural_id'], 'integer'],
            [['tipo_profesion'], 'string'],
            [['fecha_informe', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['colegiatura'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'capital_id' => Yii::t('app', 'Capital ID'),
            'persona_natural_id' => Yii::t('app', 'Persona Natural ID'),
            'colegiatura' => Yii::t('app', 'Colegiatura'),
            'tipo_profesion' => Yii::t('app', 'Tipo Profesion'),
            'fecha_informe' => Yii::t('app', 'Fecha Informe'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapital()
    {
        return $this->hasOne(Capitales::className(), ['id' => 'capital_id']);
    }
}

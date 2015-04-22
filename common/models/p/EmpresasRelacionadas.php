<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.empresas_relacionadas".
 *
 * @property integer $id
 * @property string $tipo_relacion
 * @property string $tipo_sector
 * @property string $persona_contacto
 * @property string $identificacion_contacto
 * @property string $telefono_contacto
 * @property integer $sys_pais_id
 * @property string $tipo_nacionalidad
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $persona_juridica_id
 *
 * @property PersonasJuridicas $personaJuridica
 */
class EmpresasRelacionadas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.empresas_relacionadas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_relacion', 'tipo_sector', 'persona_contacto', 'identificacion_contacto', 'telefono_contacto', 'tipo_nacionalidad', 'persona_juridica_id'], 'required'],
            [['tipo_relacion', 'tipo_sector', 'tipo_nacionalidad'], 'string'],
            [['sys_pais_id', 'persona_juridica_id'], 'integer'],
            [['fecha_inicio', 'fecha_fin', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['sys_status'], 'boolean'],
            [['persona_contacto'], 'string', 'max' => 255],
            [['identificacion_contacto'], 'string', 'max' => 20],
            [['telefono_contacto'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo_relacion' => Yii::t('app', 'Tipo Relacion'),
            'tipo_sector' => Yii::t('app', 'Tipo Sector'),
            'persona_contacto' => Yii::t('app', 'Persona Contacto'),
            'identificacion_contacto' => Yii::t('app', 'Identificacion Contacto'),
            'telefono_contacto' => Yii::t('app', 'Telefono Contacto'),
            'sys_pais_id' => Yii::t('app', 'Sys Pais ID'),
            'tipo_nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'fecha_inicio' => Yii::t('app', 'Fecha Inicio'),
            'fecha_fin' => Yii::t('app', 'Fecha Fin'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'persona_juridica_id' => Yii::t('app', 'Persona Juridica ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaJuridica()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'persona_juridica_id']);
    }
}

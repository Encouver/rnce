<?php

namespace common\models\a;

use common\models\p\PersonasJuridicas;
use Yii;

/**
 * This is the model class for table "activos.sys_gremios".
 *
 * @property integer $id
 * @property integer $persona_juridica_id
 * @property string $direccion
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property ActivosAvaluos[] $activosAvaluos
 * @property PersonasJuridicas $personaJuridica
 */
class ActivosSysGremios extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.sys_gremios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['persona_juridica_id'], 'required'],
            [['persona_juridica_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['direccion'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'persona_juridica_id' => Yii::t('app', 'Persona Juridica ID'),
            'direccion' => Yii::t('app', 'Direccion'),
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
    public function getActivosAvaluos()
    {
        return $this->hasMany(ActivosAvaluos::className(), ['gremio_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonaJuridica()
    {
        return $this->hasOne(PersonasJuridicas::className(), ['id' => 'persona_juridica_id']);
    }

    public function etiqueta(){
        return $this->personaJuridica->etiqueta();
    }
}

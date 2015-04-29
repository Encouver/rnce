<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.sys_naturales_juridicas".
 *
 * @property integer $id
 * @property string $rif
 * @property boolean $juridica
 * @property string $denominacion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property AccionistasOtros[] $accionistasOtros
 * @property Clientes[] $clientes
 * @property PersonasJuridicas[] $personasJuridicas
 * @property RelacionesContratos[] $relacionesContratos
 * @property Contratistas[] $contratistas
 * @property PersonasNaturales[] $personasNaturales
 */
class SysNaturalesJuridicas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    
     public $tipo_persona;
    public static function tableName()
    {
        return 'public.sys_naturales_juridicas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rif', 'juridica', 'denominacion','tipo_persona'], 'required'],
            [['juridica', 'sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['rif'], 'string', 'max' => 20],
            [['denominacion'], 'string', 'max' => 255],
            [['rif'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rif' => Yii::t('app', 'Rif'),
            'tipo_persona'=> Yii::t('app', 'Tipo de persona'),
            'juridica' => Yii::t('app', 'Juridica'),
            'denominacion' => Yii::t('app', 'Razon Social'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionistasOtros()
    {
        return $this->hasMany(AccionistasOtros::className(), ['natural_juridica_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Clientes::className(), ['natural_juridico_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonasJuridicas()
    {
        return $this->hasMany(PersonasJuridicas::className(), ['rif' => 'rif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelacionesContratos()
    {
        return $this->hasMany(RelacionesContratos::className(), ['natural_juridica_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistas()
    {
        return $this->hasMany(Contratistas::className(), ['natural_juridica_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonasNaturales()
    {
        return $this->hasMany(PersonasNaturales::className(), ['rif' => 'rif']);
    }
}

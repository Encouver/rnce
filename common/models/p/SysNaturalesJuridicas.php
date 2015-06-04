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
 * @property string $anho
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $natural
 */
class SysNaturalesJuridicas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
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
            [['rif', 'juridica', 'denominacion', 'anho'], 'required'],
            [['juridica', 'sys_status','nacional'], 'boolean'],
            [['creado_por', 'actualizado_por'], 'integer'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','nacional'], 'safe'],
            [['rif'], 'string', 'max' => 20],
            [['denominacion'], 'string', 'max' => 255],
            [['anho'], 'string', 'max' => 100],
            [['rif'], 'unique'],
            [['rif'],'filter','filter'=>'trim'],
            [['rif'],'filter','filter'=>'strtoupper'],
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
            'juridica' => Yii::t('app', 'Juridica'),
            'denominacion' => Yii::t('app', 'Denominación'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'nacional' => Yii::t('app', 'Nacional'),
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

    public function etiqueta(){
        return $this->rif." - ".$this->denominacion;
    }
}

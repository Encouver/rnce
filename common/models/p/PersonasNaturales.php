<?php

namespace common\models\p;

use kartik\builder\Form;
use Yii;
use kartik\builder\Form;

/**
 * This is the model class for table "public.personas_naturales".
 *
 * @property integer $id
 * @property string $primer_nombre
 * @property string $segundo_nombre
 * @property string $rif
 * @property integer $ci
 * @property integer $creado_por
 * @property string $primer_apellido
 * @property string $segundo_apellido
 * @property string $telefono_local
 * @property string $telefono_celular
 * @property string $fax
 * @property string $correo
 * @property string $pagina_web
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 * @property integer $sys_pais_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $numero_identificacion
 * @property string $nacionalidad
 *
 * @property EmpresasRelacionadas[] $empresasRelacionadas
 * @property Sucursales[] $sucursales
 * @property SysPaises $sysPais
 * @property SysNaturalesJuridicas $rif0
 * @property ContratistasContactos[] $contratistasContactos
 */
class PersonasNaturales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.personas_naturales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['primer_nombre', 'segundo_nombre','creado_por', 'primer_apellido', 'segundo_apellido', 'sys_pais_id', 'nacionalidad'], 'required'],
            [['ci', 'creado_por', 'sys_pais_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['nacionalidad'], 'string'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'pagina_web', 'facebook', 'twitter', 'instagram', 'numero_identificacion'], 'string', 'max' => 255],
            [['rif'], 'string', 'max' => 20],
            [['telefono_local', 'telefono_celular', 'fax'], 'string', 'max' => 50],
            [['correo'], 'string', 'max' => 150],
            [['rif'], 'unique'],
            [['ci'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'primer_nombre' => Yii::t('app', 'Primer Nombre'),
            'segundo_nombre' => Yii::t('app', 'Segundo Nombre'),
            'rif' => Yii::t('app', 'Rif'),
            'ci' => Yii::t('app', 'Ci'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'primer_apellido' => Yii::t('app', 'Primer Apellido'),
            'segundo_apellido' => Yii::t('app', 'Segundo Apellido'),
            'telefono_local' => Yii::t('app', 'Telefono Local'),
            'telefono_celular' => Yii::t('app', 'Telefono Celular'),
            'fax' => Yii::t('app', 'Fax'),
            'correo' => Yii::t('app', 'Correo'),
            'pagina_web' => Yii::t('app', 'Pagina Web'),
            'facebook' => Yii::t('app', 'Facebook'),
            'twitter' => Yii::t('app', 'Twitter'),
            'instagram' => Yii::t('app', 'Instagram'),
            'sys_pais_id' => Yii::t('app', 'Sys Pais ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresasRelacionadas()
    {
        return $this->hasMany(EmpresasRelacionadas::className(), ['persona_contacto_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSucursales()
    {
        return $this->hasMany(Sucursales::className(), ['persona_natural_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysPais()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'sys_pais_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRif0()
    {
        return $this->hasOne(SysNaturalesJuridicas::className(), ['rif' => 'rif']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratistasContactos()
    {
        return $this->hasMany(ContratistasContactos::className(), ['contacto_id' => 'id']);
    }
    
    public function getFormAttribs() {
    return [
        'primer_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
        'segundo_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
        'primer_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
        'segundo_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
    ];
}
}

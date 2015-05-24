<?php

namespace common\models\p;
use kartik\builder\Form;
use Yii;

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
 * @property string $telefosno_local
 * @property string $telefono_celular
 * @property string $fax
 * @property string $correo
 * @property string $pagina_web
 * @property string $facebook
 * @property string $twitter
 * @property string $instagram
 * @property string $numero_identificacion
 * @property string $nacionalidad
 * @property string $estado_civil
 * @property string $anho
 * @property integer $actualizado_por
 * @property integer $sys_pais_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el

 *
 * @property ActivosAvaluos[] $activosAvaluos
 * @property ContratistasContactos[] $contratistasContactos
 * @property EmpresasRelacionadas[] $empresasRelacionadas
 * @property SysNaturalesJuridicas $rif0
 * @property SysPaises $sysPais
 * @property Sucursales[] $sucursales

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
            [['primer_nombre', 'primer_apellido','sys_pais_id', 'nacionalidad', 'anho'], 'required'],
            [['ci', 'sys_pais_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['nacionalidad', 'estado_civil'], 'string'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'pagina_web', 'facebook', 'twitter', 'instagram', 'numero_identificacion'], 'string', 'max' => 255],
            [['rif'], 'required', 'on' => 'basico'],
            [['rif','telefono_local','telefono_celular','correo'], 'required', 'on' => 'contacto'],
            [['rif'], 'string', 'max' => 20],
            [['telefono_local', 'telefono_celular', 'fax'], 'string', 'max' => 50],
            [['correo'], 'string', 'max' => 150],
            [['anho'], 'string', 'max' => 100],
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
            'sys_pais_id' => Yii::t('app', 'Pais de Origen'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'nacionalidad' => Yii::t('app', 'Nacionalidad'),
            'estado_civil' => Yii::t('app', 'Estado Civil'),
            'anho' => Yii::t('app', 'Anho'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
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
    
    public function getFormAttribs($id) {
        
        if($id=="basico"){
            return [
        'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca rif']],
        'primer_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca primer nombre']],
        'segundo_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca segundo nombre']],
        'primer_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca primer apellido']],
        'segundo_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca segundo apellido']],
            ];
        }
        if($id=="contacto"){
            return [
        'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter rif']],
        'primer_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca primer nombre']],
        'segundo_nombre'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca segundo nombre']],
        'primer_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca primer apellido']],
        'segundo_apellido'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca segundo_apellido']],
        'telefono_local'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca telefono local']],
        'telefono_celular'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca telefono celular']],
        'fax'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca fax']],
        'correo'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca correo']],
        'pagina_web'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca pagina_web']],
        'facebook'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca fecabook']],
        'twitter'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca twitter']],
        'instagram'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca instagram']],
            ];
        }
    
    }
    public function Etiqueta(){
        return $this->ci.' - '.$this->primer_nombre.' '.$this->primer_apellido;
    }
}

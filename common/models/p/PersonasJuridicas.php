<?php

namespace common\models\p;
use kartik\builder\Form;
use common\models\p\SysPaises;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * This is the model class for table "public.personas_juridicas".
 *
 * @property integer $id
 * @property string $rif
 * @property string $razon_social
 * @property integer $creado_por
 * @property string $numero_identificacion
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_nacionalidad
* @property string $sys_pais_id
 *
 * @property ObjetosAutorizaciones[] $objetosAutorizaciones
 * @property EmpresasRelacionadas[] $empresasRelacionadas
 * @property SysNaturalesJuridicas $rif0
 * @property PolizasContratadas[] $polizasContratadas
 */
class PersonasJuridicas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $sigla;
    public $tipo_sector;
    public static function tableName()
    {
        return 'public.personas_juridicas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['razon_social','tipo_sector'], 'required'],
            [['creado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['anho','sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_nacionalidad'], 'string'],
            [['rif'],'filter','filter'=>'trim'],
            [['rif'],'filter','filter'=>'strtoupper'],
            //[['rif'],'string','min'=>10,'max'=>10],
            //['rif', 'match', 'pattern' => '/^[[JGP][0-9]{8}[0-9]$/i','message'=>'Rif no concuerda con el formato'],
            [['numero_identificacion'], 'unique'],

            [['tipo_sector'], 'string'],
            [['sigla'], 'string', 'max' => 50],
            [['sigla','rif'],'required','on'=>'conbasico'],
            [['razon_social', 'numero_identificacion'], 'string', 'max' => 255],
            [['rif'], 'unique'],
            [['razon_social'], 'unique'],
            [['rif'], 'required', 'when' => function ($model) {
                return $model->tipo_nacionalidad == "NACIONAL";
            }, 'whenClient' => "function (attribute, value) {
                return $('#personasjuridicas-tipo_nacionalidad').val() == 'NACIONAL';
            }"],
            [['rif'] , 'match', 'pattern' => '/^[[JGPjgp][0-9]{8}[0-9]$/i', 'message'=>'Rif invalido', 'when' => function ($model) {
                return $model->tipo_nacionalidad == "NACIONAL";
            }, 'whenClient' => "function (attribute, value) {
                return $('#personasnaturales-nacionalidad').val() == 'NACIONAL';
            }"],
            [['sys_pais_id','numero_identificacion'], 'required', 'when' => function ($model) {
                return $model->tipo_nacionalidad == "EXTRANJERA";
            }, 'whenClient' => "function (attribute, value) {
                return $('#personasjuridicas-tipo_nacionalidad').val() == 'EXTRANJERA';
            }"],
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
            'razon_social' => Yii::t('app', 'Razon Social'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'numero_identificacion' => Yii::t('app', 'Numero Identificacion'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_nacionalidad' => Yii::t('app', 'Tipo Nacionalidad'),
            'sigla' => Yii::t('app', 'Sigla'),
            'tipo_sector' => Yii::t('app', 'Tipo sector'),
            'sys_pais_id'=>Yii::t('app', 'Pais'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetosAutorizaciones()
    {
        return $this->hasMany(ObjetosAutorizaciones::className(), ['persona_juridica_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresasRelacionadas()
    {
        return $this->hasMany(EmpresasRelacionadas::className(), ['persona_juridica_id' => 'id']);
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
    public function getPolizasContratadas()
    {
        return $this->hasMany(PolizasContratadas::className(), ['aseguradora_id' => 'id']);
    }
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getSysPais()
    {
        return $this->hasOne(SysPaises::className(), ['id' => 'sys_pais_id']);
    }
    
    public function getFormAttribs() {
        //$data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
        if($this->scenario=="conbasico"){
             return [
            //'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data , 'options'=>['placeholder'=>'Enter username...']],

            'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca rif'],'hint'=>'Formato J123456789'],
            'razon_social'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca razon social']],
            'tipo_sector'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ],'options'=>['prompt'=>'Seleccione tipo']],
            'sigla'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca sigla']],
        ];
        }else{

            $nacionalidad=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
             return [
            'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$nacionalidad,'options'=>['prompt'=>'Seleccione Pais']],
            'sys_pais_id'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),'options'=>['prompt'=>'Seleccione Pais']],
            'numero_identificacion'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca numero identificacion']],
            'tipo_sector'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ],'options'=>['prompt'=>'Seleccione sector']],
            'razon_social'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca razon social']],
            'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca rif'],'hint'=>'Formato J123456789'],

        ];
        }
       
    }
    public function Etiqueta(){
        return $this->rif." - ".$this->razon_social;
    }
}

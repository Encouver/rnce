<?php

namespace common\models\p;
use kartik\builder\Form;
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
            [['creado_por','razon_social'], 'required'],
            [['creado_por'], 'integer'],
            [['sys_status'], 'boolean'],
            [['anho','sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['tipo_nacionalidad'], 'string'],
            [['rif'], 'string', 'max' => 20],
            [['tipo_sector'], 'string'],
            [['sigla'], 'string', 'max' => 50],
            [['tipo_sector','sigla','rif'],'required','on'=>'conbasico'],
            [['razon_social', 'numero_identificacion'], 'string', 'max' => 255],
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
    
    public function getFormAttribs($id) {
        //$data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
    if($id=="conbasico"){
         return [
        //'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data , 'options'=>['placeholder'=>'Enter username...']],
        
        'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca rif']],
        'razon_social'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca razon social']],
        'tipo_sector'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ],'options'=>['prompt'=>'Seleccione tipo']],
        'sigla'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca sigla']],
    ];
    }
    if($id=="posextranjero"){
        $data=[ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ];
         return [             
        'tipo_nacionalidad'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>$data , 'options'=>['placeholder'=>'Enter username...']],
        'numero_identificacion'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Introduzca rif']],
        'razon_social'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Introduzca razon social']],
    ];
    }
       
    }
    public function getFormAttribsnacional() {
      
    return [
        'rif'=>['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'introduza su rif']],
        'razon_social'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'Enter username...']],
       
    ];
    }
    public function Etiqueta(){
        return $this->rif." - ".$this->razon_social;
    }
}

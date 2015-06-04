<?php

namespace common\models\p;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use common\models\p\SysPaises;
use kartik\widgets\Select2;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\p\Acciones;
use common\models\p\Certificados;
use common\models\p\Suplementarios;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\PrincipiosContables;
use Yii;

/**
 * This is the model class for table "public.denominaciones_comerciales".
 *
 * @property integer $id
 * @property string $codigo_situr
 * @property string $cooperativa_capital
 * @property string $cooperativa_distribuicion
 * @property integer $contratista_id
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property string $tipo_denominacion
 * @property string $tipo_subdenominacion
 * @property string $documento_registrado_id
 *
 * @property Contratistas $contratista
 * @property ActasConstitutivas[] $actasConstitutivas
 */
class DenominacionesComerciales extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public $sector;
    public static function tableName()
    {
        return 'public.denominaciones_comerciales';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cooperativa_capital', 'cooperativa_distribuicion', 'tipo_denominacion', 'tipo_subdenominacion'], 'string'],
            [['contratista_id', 'tipo_denominacion','documento_registrado_id'], 'required'],
            [['contratista_id','documento_registrado_id'], 'integer'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['codigo_situr','sector'], 'string', 'max' => 255],
            [['tipo_subdenominacion'], 'required', 'when' => function ($model) {
                return ($model->tipo_denominacion == "COMANDITA" || $model->tipo_denominacion == "SOCIEDAD ANONIMA" || $model->tipo_denominacion == "ASOCIACION VICIL" || $model->tipo_denominacion == "SOCIEDAD CIVIL" || $model->tipo_denominacion == "ORGANIZACION SOCIOPRODUCTIVA" || $model->tipo_denominacion == "EMPRESA EXTRANJERA" || $model->tipo_denominacion == "FUNDACION");
            }, 'whenClient' => "function (attribute, value) {
                return $('#denominacionescomerciales-tipo_denominacion').val() == 'COMANDITA' || $('#denominacionescomerciales-tipo_denominacion').val() == 'SOCIEDAD ANONIMA' || $('#denominacionescomerciales-tipo_denominacion').val() == 'ASOCIACION CIVIL' || $('#denominacionescomerciales-tipo_denominacion').val() == 'SOCIEDAD CIVIL' || $('#denominacionescomerciales-tipo_denominacion').val() == 'ORGANIZACION SOCIOPRODUCTIVA' || $('#denominacionescomerciales-tipo_denominacion').val() == 'EMPRESA EXTRANJERA' || $('#denominacionescomerciales-tipo_denominacion').val() == 'FUNDACION';
            }"],
            [['codigo_situr'], 'required', 'when' => function ($model) {
                return ($model->tipo_denominacion == "ORGANIZACION SOCIOPRODUCTIVA");
            }, 'whenClient' => "function (attribute, value) {
                return $('#denominacionescomerciales-tipo_denominacion').val() == 'ORGANIZACION SOCIOPRODUCTIVA';
            }"],
            [['cooperativa_capital','cooperativa_distribuicion'], 'required', 'when' => function ($model) {
                return ($model->tipo_denominacion == "COOPERATIVA");
            }, 'whenClient' => "function (attribute, value) {
                return $('#denominacionescomerciales-tipo_denominacion').val() == 'COOPERATIVA';
            }"]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'codigo_situr' => Yii::t('app', 'Codigo Situr'),
            'cooperativa_capital' => Yii::t('app', 'Cooperativa Capital'),
            'cooperativa_distribuicion' => Yii::t('app', 'Cooperativa Distribuicion'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'tipo_denominacion' => Yii::t('app', 'Tipo Denominacion'),
            'tipo_subdenominacion' => Yii::t('app', 'Tipo Subdenominacion'),
            'sector'=>Yii::t('app', 'Tipo Sector'),
            'documento_registrado_id'=>Yii::t('app', 'Documento Registrado'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratista()
    {
        return $this->hasOne(Contratistas::className(), ['id' => 'contratista_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentoRegistrado()
    {
        return $this->hasOne(ActivosDocumentosRegistrados::className(), ['id' => 'documento_registrado_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActasConstitutivas()
    {
        return $this->hasMany(ActasConstitutivas::className(), ['denominacion_comercial_id' => 'id']);
    }
    public function getFormAttribs() {

       $denominacion = [
    ['id' => 'COMPAÑIA ANONIMA', 'name' => 'COMPAÑIA ANONIMA'],
    ['id' => 'SOCIEDAD ANONIMA', 'name' => 'SOCIEDAD ANONIMA'],
    ['id' => 'COMANDITA', 'name' => 'COMANDITA'],
    ['id' => 'ASOCIACION CIVIL', 'name' => 'ASOCIACION CIVIL'],
    ['id' => 'SOCIEDAD CIVIL', 'name' => 'SOCIEDAD CIVIL'],
    ['id' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA', 'name' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA'],
    ['id' => 'COMPAÑIA NOMBRE COLECTIVO', 'name' => 'COMPAÑIA NOMBRE COLECTIVO'],
    ['id' => 'ORGANIZACION SOCIOPRODUCTIVA', 'name' => 'ORGANIZACION SOCIOPRODUCTIVA'],
    ['id' => 'COOPERATIVA', 'name' => 'COOPERATIVA'],
    ['id' => 'EMPRESA EXTRANJERA', 'name' => 'EMPRESA EXTRANJERA'],
        
        ];

      if($this->sector == "PRIVADO"){
         $denominacion = array_merge ( $denominacion ,[['id' => 'FUNDACION', 'name' => 'FUNDACION']] );
    
    }else{
        if($this->sector=="NATURAL"){
                $denominacion = [
        ['id' => 'PERSONA NATURAL', 'name' => 'PERSONA NATURAL'],
        ['id' => 'FIRMA PERSONAL', 'name' => 'FIRMA PERSONAL'],];
        }
    }
        return [
        'tipo_denominacion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>ArrayHelper::map($denominacion, 'id', 'name'),'options'=>['prompt'=>'Seleccione denominacion']],
        'tipo_subdenominacion'=>[
                'type'=>Form::INPUT_WIDGET, 
                'widgetClass'=>'\kartik\widgets\DepDrop', 
                'options'=>['pluginOptions'=>[
                'depends'=>['denominacionescomerciales-tipo_denominacion'],
            'placeholder'=>'Select...',
            'url'=>Url::to(['denominaciones-comerciales/subcat'])
                ]],
            ],
            'codigo_situr'=>['type'=>Form::INPUT_TEXT,'options'=>['placeholder'=>'codigo situr']],
           
         'cooperativa_capital'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'SUPLEMENTARIO' => 'SUPLEMENTARIO', 'LIMITADO' => 'LIMITADO', ],'options'=>['prompt'=>'Seleccione denominacion']],
         'cooperativa_distribuicion'=>['type'=>Form::INPUT_DROPDOWN_LIST,'items'=>[ 'UTILIDADES' => 'UTILIDADES', 'EXCEDENTES' => 'EXCEDENTES', ],'options'=>['prompt'=>'Seleccione denominacion']],     
         'documento_registrado_id'=>[ // primary key attribute
                'type'=>Form::INPUT_HIDDEN,
                'columnOptions'=>['hidden'=>true]
                ],
         ];
       
    
    

    }
     public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
           }
          $denominacion= DenominacionesComerciales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'documento_registrado_id'=>$registro->id]);
           if(isset($denominacion)){
               
                return true;   
            }else{
                $this->documento_registrado_id=$registro->id;
                return false;
            }
        }else{
            return true;
        }
    }
    public function Asignarprincipio(){
        $principio_contable= PrincipiosContables::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id]);
         if(!isset($principio_contable)){
             $principio_contable= new PrincipiosContables();
         }     
         
           if($this->tipo_denominacion=='PERSONA NATURAL'){
                    $principio_contable->principio_contable='PN';
                     $principio_contable->codigo_sudeaseg=null;
             }else{
                  if($this->tipo_denominacion=='FIRMA PERSONAL'){
                    $principio_contable->principio_contable='FP';
                    $principio_contable->codigo_sudeaseg=null;
                }else{
                     if($this->tipo_denominacion=='COMANDITA' || $this->tipo_denominacion=='SOCIEDAD DE RESPONSABILIDAD LIMITADA' || $this->tipo_denominacion=='COMPAÑIA NOMBRE COLECTIVO' || $this->tipo_denominacion=='FUNDACION' || $this->tipo_denominacion=='ASOCIACION CIVIL' || $this->tipo_denominacion=='SOCIEDAD CIVIL'  || ($this->tipo_denominacion=='COOPERATIVA' && $this->cooperativa_distribuicion=="UTILIDADES")){
                    $principio_contable->principio_contable='PYME';
                    $principio_contable->codigo_sudeaseg=null;
                    }else{
                        if($this->tipo_denominacion=='ORGANIZACION SOCIOPRODUCTIVA'){
                             $principio_contable->principio_contable='OSP';
                             $principio_contable->codigo_sudeaseg=null;
                        }else{
                            if($this->tipo_denominacion=='COOPERATIVA' && $this->cooperativa_distribuicion=="EXCEDENTES"){
                             $principio_contable->principio_contable='COOP';
                             $principio_contable->codigo_sudeaseg=null;
                                 }
                        }
                    }
                }
             }
             if($principio_contable->save()){
                 return true;
             }else{
                 return false;
             }
            
       
    }
     public function Tieneotrosdatos()
    {
         if($this->tipo_denominacion=="COOPERATIVA" && $this->cooperativa_capital!="SUPLEMENTARIO"){
             $accion= Acciones::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
             $suplementario= Suplementarios::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
             if(isset($accion)){
                 foreach ($accion as $acciones) {
                     $acciones->delete();
                     
                 }
             }
             if(isset($suplementario)){
                 foreach ($suplementario as $suplementarios) {
                     $suplementarios->delete();
                     
                 }
             }
         }else{
             if($this->tipo_denominacion=="COOPERATIVA" && $this->cooperativa_capital=="SUPLEMENTARIO"){
             $accion= Acciones::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
             $certificado= Certificados::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
             if(isset($accion)){
                 foreach ($accion as $acciones) {
                     $acciones->delete();
                     
                 }
             }
             if(isset($certificado)){
                 foreach ($certificado as $certificados) {
                     $certificados->delete();
                     
                 }
             }
            }else{
                 $suplementario= Suplementarios::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
                 $certificado= Certificados::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
                   if(isset($suplementario)){
                        foreach ($suplementario as $suplementarios) {
                            $suplementarios->delete();
                     
                            }
                            }
                 if(isset($certificado)){
                        foreach ($certificado as $certificados) {
                            $certificados->delete();
                     
                        }
                    }
                 
            }
         }
         return true;
        
       
    }
}
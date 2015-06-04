<?php

namespace common\models\p;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\Contratistas;
use common\models\p\ModificacionesActas;
use common\models\p\CierresEjercicios;
use common\models\p\ObjetosSociales;
use common\models\p\RazonesSociales;
use common\models\p\Sucursales;
use common\models\p\FondosReservas;
use common\models\p\ComisariosAuditores;
use common\models\p\DuracionesEmpresas;
use common\models\p\OrigenesCapitales;
use common\models\p\CertificacionesAportes;
use common\models\p\ActividadesEconomicas;
use common\models\p\Acciones;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\Certificados;
use common\models\p\Suplementarios;
use common\models\p\Domicilios;
use common\models\p\AccionistasOtros;
use common\models\p\DenominacionesComerciales;
use Yii;


/**
 * This is the model class for table "actas_constitutivas".
 *
 * @property integer $id
 * @property integer $contratista_id
 * @property integer $documento_registrado_id
 * @property integer $denominacion_comercial_id
 * @property integer $duracion_empresa_id
 * @property integer $objeto_social_id
 * @property integer $razon_social_id
 * @property integer $cierre_ejercicio_id
 * @property integer $creado_por
 * @property integer $actualizado_por
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property integer $domicilio_fiscal_id
 * @property integer $domicilio_principal_id
 * @property boolean $acciones
 * @property boolean $certificados
 * @property boolean $suplementarios
 * @property string $capital_suscrito
 * @property string $capital_pagado
 * @property boolean $actual
 * @property integer $modificacion_acta_id
 *
 * @property AccionesDisminuidas[] $accionesDisminuidas
 * @property ActivosDocumentosRegistrados $documentoRegistrado
 * @property CierresEjercicios $cierreEjercicio
 * @property Contratistas $contratista
 * @property DenominacionesComerciales $denominacionComercial
 * @property Domicilios $domicilioFiscal
 * @property Domicilios $domicilioPrincipal
 * @property DuracionesEmpresas $duracionEmpresa
 * @property ModificacionesActas $modificacionActa
 * @property ObjetosSociales $objetoSocial
 * @property RazonesSociales $razonSocial
 * @property AportesCapitalizar[] $aportesCapitalizars
 * @property AumentosCapitales[] $aumentosCapitales
 * @property Capitales[] $capitales
 * @property CertificadosDisminuidos[] $certificadosDisminuidos
 * @property CorreccionesMonetarias[] $correccionesMonetarias
 * @property DecretosDivExcedentes[] $decretosDivExcedentes
 * @property EmpresasFusionadas[] $empresasFusionadas
 * @property FondosEmergencias[] $fondosEmergencias
 * @property FusionesEmpresariales[] $fusionesEmpresariales
 * @property LimitacionesCapitales[] $limitacionesCapitales
 * @property LimitacionesCapitalesAfectados[] $limitacionesCapitalesAfectados
 * @property ModificacionesBalances[] $modificacionesBalances
 * @property SuplementariosDisminuidos[] $suplementariosDisminuidos
 */
class ActasConstitutivas extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'actas_constitutivas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'cierre_ejercicio_id', 'domicilio_fiscal_id', 'domicilio_principal_id', 'capital_suscrito', 'capital_pagado', 'modificacion_acta_id'], 'required'],
            [['contratista_id', 'documento_registrado_id', 'denominacion_comercial_id', 'duracion_empresa_id', 'objeto_social_id', 'razon_social_id', 'cierre_ejercicio_id', 'creado_por', 'actualizado_por', 'domicilio_fiscal_id', 'domicilio_principal_id', 'modificacion_acta_id'], 'integer'],
            [['sys_status', 'acciones', 'certificados', 'suplementarios', 'actual'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['capital_suscrito', 'capital_pagado'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contratista_id' => Yii::t('app', 'Contratista ID'),
            'documento_registrado_id' => Yii::t('app', 'Documento Registrado ID'),
            'denominacion_comercial_id' => Yii::t('app', 'Denominacion Comercial ID'),
            'duracion_empresa_id' => Yii::t('app', 'Duracion Empresa ID'),
            'objeto_social_id' => Yii::t('app', 'Objeto Social ID'),
            'razon_social_id' => Yii::t('app', 'Razon Social ID'),
            'cierre_ejercicio_id' => Yii::t('app', 'Cierre Ejercicio ID'),
            'creado_por' => Yii::t('app', 'Creado Por'),
            'actualizado_por' => Yii::t('app', 'Actualizado Por'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'domicilio_fiscal_id' => Yii::t('app', 'Domicilio Fiscal ID'),
            'domicilio_principal_id' => Yii::t('app', 'Domicilio Principal ID'),
            'acciones' => Yii::t('app', 'Acciones'),
            'certificados' => Yii::t('app', 'Certificados'),
            'suplementarios' => Yii::t('app', 'Suplementarios'),
            'capital_suscrito' => Yii::t('app', 'Capital Suscrito'),
            'capital_pagado' => Yii::t('app', 'Capital Pagado'),
            'actual' => Yii::t('app', 'Actual'),
            'modificacion_acta_id' => Yii::t('app', 'Modificacion Acta ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccionesDisminuidas()
    {
        return $this->hasMany(AccionesDisminuidas::className(), ['acta_constitutiva_id' => 'id']);
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
    public function getCierreEjercicio()
    {
        return $this->hasOne(CierresEjercicios::className(), ['id' => 'cierre_ejercicio_id']);
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
    public function getDenominacionComercial()
    {
        return $this->hasOne(DenominacionesComerciales::className(), ['id' => 'denominacion_comercial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioFiscal()
    {
        return $this->hasOne(Domicilios::className(), ['id' => 'domicilio_fiscal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDomicilioPrincipal()
    {
        return $this->hasOne(Domicilios::className(), ['id' => 'domicilio_principal_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDuracionEmpresa()
    {
        return $this->hasOne(DuracionesEmpresas::className(), ['id' => 'duracion_empresa_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModificacionActa()
    {
        return $this->hasOne(ModificacionesActas::className(), ['id' => 'modificacion_acta_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjetoSocial()
    {
        return $this->hasOne(ObjetosSociales::className(), ['id' => 'objeto_social_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRazonSocial()
    {
        return $this->hasOne(RazonesSociales::className(), ['id' => 'razon_social_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAportesCapitalizars()
    {
        return $this->hasMany(AportesCapitalizar::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAumentosCapitales()
    {
        return $this->hasMany(AumentosCapitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCapitales()
    {
        return $this->hasMany(Capitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCertificadosDisminuidos()
    {
        return $this->hasMany(CertificadosDisminuidos::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCorreccionesMonetarias()
    {
        return $this->hasMany(CorreccionesMonetarias::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDecretosDivExcedentes()
    {
        return $this->hasMany(DecretosDivExcedentes::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresasFusionadas()
    {
        return $this->hasMany(EmpresasFusionadas::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFondosEmergencias()
    {
        return $this->hasMany(FondosEmergencias::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFusionesEmpresariales()
    {
        return $this->hasMany(FusionesEmpresariales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitales()
    {
        return $this->hasMany(LimitacionesCapitales::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLimitacionesCapitalesAfectados()
    {
        return $this->hasMany(LimitacionesCapitalesAfectados::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModificacionesBalances()
    {
        return $this->hasMany(ModificacionesBalances::className(), ['acta_constitutiva_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuplementariosDisminuidos()
    {
        return $this->hasMany(SuplementariosDisminuidos::className(), ['acta_constitutiva_id' => 'id']);
    }
    public function Existeregistro(){
       $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);       
       $registromodificacion = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>2,'proceso_finalizado'=>false]);      
       if(isset($registro) || isset($registromodificacion)){
           if(isset($registromodificacion)){
               $registro=$registromodificacion;
             
           }else{
               $modificacion_acta= ModificacionesActas::findOne(['documento_registrado_id'=>$registro->id]);
               if(!isset($modificacion_acta)){
                   $modificacion_acta = new ModificacionesActas();
                   $modificacion_acta->documento_registrado_id=$registro->id;
                   $modificacion_acta->save();
               }
               
           }
        
                $this->documento_registrado_id = $registro->id;
                 $this->contratista_id = Yii::$app->user->identity->contratista_id;
                return false;
            
        }else{
            return true;
        }
    }
    public function Datoscompletos(){
        $resultado="exitoso";
         $contratista = Contratistas::findOne(['id'=>Yii::$app->user->identity->contratista_id]);
         if(isset($contratista)){
             $natural_juridica = SysNaturalesJuridicas::findOne(['id'=>$contratista->natural_juridica_id]);
         }else{
             $resultado="Persona Juridica Incompleta";
             return $resultado;
         }
         $modificacion_acta= ModificacionesActas::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $denominacion_comercial = DenominacionesComerciales::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $duracion_empresa = DuracionesEmpresas::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $cierre_ejercicio= CierresEjercicios::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $objeto_social= ObjetosSociales::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $actividad_economica= ActividadesEconomicas::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         
         $domicilio_fiscal= Domicilios::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'fiscal'=>true]);
          
         $domicilio_principal= Domicilios::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'fiscal'=>false]);
         $razon_social= RazonesSociales::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $origen_capital= OrigenesCapitales::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $certificacion_aporte= CertificacionesAportes::findOne(['documento_registrado_id'=>$this->documento_registrado_id]);
         $accionista_otro= AccionistasOtros::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
         $comisario= ComisariosAuditores::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
         $fondo_reserva= FondosReservas::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
         $sucursal= Sucursales::findAll(['documento_registrado_id'=>$this->documento_registrado_id]);
         if(isset($denominacion_comercial)){
             if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
             $capital_suscrito=Acciones::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>true]);
             $capital_pagado= Acciones::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>false]);
             $this->acciones=true;
              }else{   if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital!="SUPLEMENTARIO"){
                       $capital_suscrito= Certificados::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_certificado'=>'PRINCIPAL', 'suscrito'=>true]);
                        $capital_pagado= Certificados::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_certificado'=>'PRINCIPAL', 'suscrito'=>false]);
                       
                        $this->certificados=true;
                        
                 }else{
                     $capital_suscrito= Suplementarios::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_suplementario'=>'PRINCIPAL', 'suscrito'=>true]);
                    $capital_pagado= Suplementarios::findOne(['documento_registrado_id'=>$this->documento_registrado_id, 'tipo_suplementario'=>'PRINCIPAL', 'suscrito'=>false]);
            
                     $this->suplementarios=true;
                 }
              }
                 if(!isset($capital_suscrito)){
                     $resultado="Debe agregar el capital";
                    return $resultado;
                    
                 }
             
       
         }else{
                  $resultado="Debe crear una denominacion comercial";
                    return $resultado;
             }
      
        if(!isset($natural_juridica)){
             $resultado="Debe crear datos natural juridica";
                    return $resultado;
        }
         if(!isset($origen_capital)){
             $resultado="Debe agregar el origen del capital";
                    return $resultado;
        }
         if(!isset($duracion_empresa)){
             $resultado="Debe agregar la duracion de la empresa";
                    return $resultado;
        }
         if(!isset($cierre_ejercicio)){
             $resultado="Debe agregar cierre ejercicio economico";
                    return $resultado;
        }
        if(!isset($actividad_economica)){
             $resultado="Debe agregar actividades economicas";
                    return $resultado;
        }
        if(!isset($objeto_social)){
             $resultado="Debe agregar objeto social";
                    return $resultado;
        }
         if(!isset($razon_social)){
             $resultado="Debe agregar razon social";
                    return $resultado;
        }
         if(!isset($domicilio_principal)){
             $resultado="Debe agregar domicilio principal";
                    return $resultado;
        }
         if(!isset($domicilio_fiscal)){
             $resultado="Debe agregar domicilio fiscal";
                    return $resultado;
        }
         if(!isset($accionista_otro)){
             $resultado="Debe agregar accionista otro";
                    return $resultado;
        }
         if(!isset($fondo_reserva)){
             $resultado="Debe agregar fondo_reserva";
                    return $resultado;
        }
         if(!isset($comisario)){
             $resultado="Debe agregar comisarios";
                    return $resultado;
        }
 
                     $this->capital_suscrito=$capital_suscrito->capital;
                     $this->capital_pagado=$capital_pagado->capital;
                     if($origen_capital->sumarmonto() < $this->capital_pagado){
                         $resultado="Debe agregar mas origen capital";
                    return $resultado;
                     }
                     $this->denominacion_comercial_id= $denominacion_comercial->id;
                     $this->duracion_empresa_id= $duracion_empresa->id;
                     $this->objeto_social_id= $objeto_social->id;
                     $this->razon_social_id= $razon_social->id;
                     $this->cierre_ejercicio_id= $cierre_ejercicio->id;
                     $this->domicilio_fiscal_id= $domicilio_fiscal->id;
                     $this->domicilio_principal_id= $domicilio_principal->id;
                     $this->modificacion_acta_id= $modificacion_acta->id;
                     return $resultado;
                 
    }
}

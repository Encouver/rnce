<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ActasConstitutivas;
use common\models\p\Contratistas;
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
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\Acciones;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\Certificados;
use common\models\p\Suplementarios;
use common\models\p\Domicilios;
use common\models\p\AccionistasOtros;
use common\models\p\DenominacionesComerciales;
use backend\models\ActasConstitutivasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
/**
 * ActasConstitutivasController implements the CRUD actions for ActasConstitutivas model.
 */
class ActasConstitutivasController extends BaseController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ActasConstitutivas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActasConstitutivasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ActasConstitutivas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ActasConstitutivas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActasConstitutivas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionCreateacta()
    {
        $model = new ActasConstitutivas();

       if(!$model->existeregistro()){
           $mensaje=$model->datoscompletos();
          if($mensaje=="exitoso"){
                $transaction = \Yii::$app->db->beginTransaction();
           try {
                $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1,'proceso_finalizado'=>false]);
                $registro->proceso_finalizado=true;
                if(!$registro->save()){
                $transaction->rollBack();
                 Yii::$app->session->setFlash('error','Imposible la carga de datos');
                        return $this->redirect(['resumenacta']);
                 
                }else{
                    if($model->save()){
                        $transaction->commit();
                        Yii::$app->session->setFlash('success','Datos guardados con exito');
                        return $this->redirect(['resumenacta']);
                    }else{
                         $transaction->rollBack();
                    }
                }
           }catch (Exception $e) {
               $transaction->rollBack();
           }
         
        }else{
             Yii::$app->session->setFlash('error',$mensaje);
                        return $this->redirect(['resumenacta']);
        }
       }else{
           Yii::$app->session->setFlash('error','No existe un acta o modificacion valida');
                        return $this->redirect(['resumenacta']);
           
       }
    }
    public function actionCrearcapitalsuscrito()
    {
       $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
         $denominacion_comercial= DenominacionesComerciales::findOne(['contratista_id'=>$usuario->contratista_id]);
      if(isset($denominacion_comercial)){
         if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
             $accion_acta = new Acciones();
           
             $accion_acta->scenario = 'principal';
              return $this->redirect(['acciones/index']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
             $certificado_acta = new Certificados();
             $msg=null;
             $certificado_acta->scenario = 'principal';
              return $this->redirect(['certificados/index']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
             $suplementario_acta = new Suplementarios();
             $msg=null;
             $suplementario_acta->scenario = 'principal';
              return $this->redirect(['suplementarios/index']);
         }
         
      }else{
            Yii::$app->session->setFlash('error','Debe agregar una denominacion comercial');
             return $this->redirect(['denominaciones-comerciales/index']);
         }

    }
    public function actionCrearpagocapital()
    {
       $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
      if(isset($acta)){
          $denominacion_comercial= DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
         if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
              return $this->redirect(['acciones/pagocapital']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
              return $this->redirect(['certificados/pagocapital']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
              return $this->redirect(['suplementarios/pagocapital']);
         }
         
      }else{
            Yii::$app->session->setFlash('error','Acta constitutiva no creada');
             return $this->redirect(['resumenacta']);
         }

    }
    public function actionCrearaumentocapital()
    {
       $acta= ActasConstitutivas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'actual'=>true]);
      if(isset($acta)){
          $denominacion_comercial= DenominacionesComerciales::findOne($acta->denominacion_comercial_id);
         if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
              return $this->redirect(['acciones/aumentocapital']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='LIMITADO'){
              return $this->redirect(['certificados/aumentocapital']);
         }
         if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital=='SUPLEMENTARIO'){
              return $this->redirect(['suplementarios/aumentocapital']);
         }
         
      }else{
            Yii::$app->session->setFlash('error','Acta constitutiva no creada');
             return $this->redirect(['resumenacta']);
         }

    }
     public function actionResumenacta()
    {
         $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
         $contratista = Contratistas::findOne(['id'=>Yii::$app->user->identity->contratista_id]);
         $natural_juridica = SysNaturalesJuridicas::findOne(['id'=>$contratista->natural_juridica_id]);
         $msgDocumentoRegistrado= "Debe Crear un Documento Registrado";
         $msgDenominacionComercial= "Debe crear una Denominacion Comercial";
         $msgNaturalJuridica= "Debe crear datos del contratista";
         $msgDuracionEmpresa= "Debe agregar la duracion de la empresa";
         $msgCierreEjercicio= "Debe agregar cierre ejercicio economico";
         $msgObjetoSocial= "Debe agregar objeto social";
         $msgActividadEconomica= "Debe agregar actividades economicas";
         $msgDomicilioFiscal= "Debe agregar domicilio fiscal";
         $msgDomicilioPrincipal= "Debe agregar domicilio principal";
         $msgRazonSocial= "Debe agregar razon social";
         $msgOrigenCapital= "Debe agregar el origen del capital";
         $msgAccionistaOtro= "Debe agregar accionistas";
         $msgComisario="Debe agregar comisarios";
         $msgSucursal= "Si posee sucursales puede agregarlas";
         $msgFondoReserva="Debe agregar fondo reserva";
        // $msgCertificacionAporte= "Debe agregar certificacion de aportes";
         $msgCapital= "Debe agregar el capital";
         $boton= false;
         if(isset($natural_juridica)){
             $msgNaturalJuridica= null;
         }
         if(isset($registro)){
             $msgDocumentoRegistrado= null;
         $denominacion_comercial = DenominacionesComerciales::findOne(['documento_registrado_id'=>$registro->id]);
         $duracion_empresa = DuracionesEmpresas::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($duracion_empresa)){
             $msgDuracionEmpresa= null;
         }
         $cierre_ejercicio= CierresEjercicios::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($cierre_ejercicio)){
             $msgCierreEjercicio= null;
         }
         $objeto_social= ObjetosSociales::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($objeto_social)){
            $msgObjetoSocial= null;
         }
         $actividad_economica= ActividadesEconomicas::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($actividad_economica)){
            $msgActividadEconomica= null;
         }
         $domicilio_fiscal= Domicilios::findOne(['documento_registrado_id'=>$registro->id, 'fiscal'=>true]);
           if(isset( $domicilio_fiscal)){
            $msgDomicilioFiscal= null;
         }
         $domicilio_principal= Domicilios::findOne(['documento_registrado_id'=>$registro->id, 'fiscal'=>false]);
          if(isset($domicilio_principal)){
            $msgDomicilioPrincipal= null;
         }
         $razon_social= RazonesSociales::findOne(['documento_registrado_id'=>$registro->id]);
         if(isset($razon_social)){
            $msgRazonSocial= null;
         }
         $origen_capital_efectivo= OrigenesCapitales::findOne(['documento_registrado_id'=>$registro->id,'efectivo'=>true]);
         if(isset($origen_capital_efectivo)){
            $origen_capital_efectivo= OrigenesCapitales::findAll(['documento_registrado_id'=>$registro->id,'efectivo'=>true]);
         }
         $origen_capital_banco= OrigenesCapitales::findOne(['documento_registrado_id'=>$registro->id,'banco'=>true]);
          if(isset($origen_capital_banco)){
            $origen_capital_banco= OrigenesCapitales::findAll(['documento_registrado_id'=>$registro->id,'banco'=>true]);
         }
         $origen_capital_bien= OrigenesCapitales::findOne(['documento_registrado_id'=>$registro->id,'bien'=>true]);
          if(isset($origen_capital_bien)){
            $origen_capital_bien= OrigenesCapitales::findAll(['documento_registrado_id'=>$registro->id,'bien'=>true]);
         }
          if(isset($origen_capital_bien) || isset($origen_capital_banco) || isset($origen_capital_efectivo)){
           $msgOrigenCapital=null;
         }
         /*$certificacion_aporte= CertificacionesAportes::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($certificacion_aporte)){
           $msgCertificacionAporte=null;
         }*/
         $accionista_otro= AccionistasOtros::findOne(['documento_registrado_id'=>$registro->id]);
         if(isset($accionista_otro)){
           $msgAccionistaOtro=null;
           $accionista_otro= AccionistasOtros::findAll(['documento_registrado_id'=>$registro->id]);
         }
         $comisario= ComisariosAuditores::findOne(['documento_registrado_id'=>$registro->id]);
         if(isset($comisario)){
             $msgComisario=null;
             $comisario= ComisariosAuditores::findAll(['documento_registrado_id'=>$registro->id]);
         }
         $fondo_reserva= FondosReservas::findOne(['documento_registrado_id'=>$registro->id]);
         if(isset($fondo_reserva)){
             $msgFondoReserva=null;
              $fondo_reserva= FondosReservas::findAll(['documento_registrado_id'=>$registro->id]);
         }
         $sucursal= Sucursales::findOne(['documento_registrado_id'=>$registro->id]);
          if(isset($sucursal)){
              $msgSucursal=null;
              $sucursal= Sucursales::findAll(['documento_registrado_id'=>$registro->id]);
         }
       
         if(isset($denominacion_comercial)){
             $msgDenominacionComercial= null;
             if($denominacion_comercial->tipo_denominacion!="COOPERATIVA"){
                 $capital_suscrito=Acciones::findOne(['documento_registrado_id'=>$registro->id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>true]);
                 $capital_pagado= Acciones::findOne(['documento_registrado_id'=>$registro->id, 'tipo_accion'=>'PRINCIPAL', 'suscrito'=>false]);
                 
             }else{
                 if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" && $denominacion_comercial->cooperativa_capital!="SUPLEMENTARIO"){
                       $capital_suscrito= Certificados::findOne(['documento_registrado_id'=>$registro->id, 'tipo_certificado'=>'PRINCIPAL', 'suscrito'=>true]);
                        $capital_pagado= Certificados::findOne(['documento_registrado_id'=>$registro->id, 'tipo_certificado'=>'PRINCIPAL', 'suscrito'=>false]);
                 }else{
                     $capital_suscrito= Suplementarios::findOne(['documento_registrado_id'=>$registro->id, 'tipo_suplementario'=>'PRINCIPAL', 'suscrito'=>true]);
                    $capital_pagado= Suplementarios::findOne(['documento_registrado_id'=>$registro->id, 'tipo_suplementario'=>'PRINCIPAL', 'suscrito'=>false]);
         
                 }
             }
             if(isset($capital_suscrito)){
              $msgCapital=null;
            }
            if(isset($fondo_reserva) && isset($comisario) && isset($accionista_otro) && is_null($msgCapital) && isset($domicilio_principal) && isset($domicilio_fiscal) && isset($capital_suscrito) && isset($actividad_economica) && isset($razon_social) && isset($natural_juridica) && isset($registro) && isset($denominacion_comercial) && isset($duracion_empresa) && isset($cierre_ejercicio) && isset($objeto_social)){
                $boton=true;
            }
             
             return $this->render('resumenacta', [
                'contratista'=>$contratista,
               'natural_juridica'=>$natural_juridica,
                'registro'=>$registro,
                'duracion_empresa'=>$duracion_empresa,
                'denominacion_comercial'=>$denominacion_comercial,
                'cierre_ejercicio'=>$cierre_ejercicio,
                'objeto_social'=>$objeto_social,
                'razon_social'=>$razon_social,
                'actividad_economica'=>$actividad_economica,
                'capital_suscrito'=>$capital_suscrito,
                'capital_pagado'=>$capital_pagado,
                'domicilio_fiscal'=>$domicilio_fiscal,
                'domicilio_principal'=>$domicilio_principal,
                'origen_capital_efectivo'=>$origen_capital_efectivo,
                'origen_capital_banco'=>$origen_capital_banco,
                'origen_capital_bien'=>$origen_capital_bien,
                //'certificacion_aporte'=>$certificacion_aporte,
                'accionista_otro'=>$accionista_otro,
                'comisario'=>$comisario,
                'fondo_reserva'=>$fondo_reserva,
                'sucursal'=>$sucursal,
                'msgDenominacionComercial'=>$msgDenominacionComercial,
                'msgDocumentoRegistrado'=>$msgDocumentoRegistrado,
                'msgNaturalJuridica'=>$msgNaturalJuridica,
                'msgDuracionEmpresa'=>$msgDuracionEmpresa,
                'msgCierreEjercicio'=>$msgCierreEjercicio,
                'msgObjetoSocial'=>$msgObjetoSocial,
                'msgActividadEconomica'=>$msgActividadEconomica,
                'msgDomicilioFiscal'=>$msgDomicilioFiscal,
                'msgDomicilioPrincipal'=>$msgDomicilioPrincipal,
                'msgRazonSocial'=>$msgRazonSocial,
                'msgOrigenCapital'=>$msgOrigenCapital,
                'msgAccionistaOtro'=>$msgAccionistaOtro,
                'msgComisario'=>$msgComisario,
                'msgSucursal'=>$msgSucursal,
                //'msgCertificacionAporte'=>$msgCertificacionAporte,
                'msgFondoReserva'=>$msgFondoReserva,
                'msgCapital'=>$msgCapital,
                'boton'=>$boton,
            ]);
         }     
          return $this->render('resumenacta', [
                'contratista'=>$contratista,
               'natural_juridica'=>$natural_juridica,
                'registro'=>$registro,
                'duracion_empresa'=>$duracion_empresa,
                'denominacion_comercial'=>$denominacion_comercial,
                'cierre_ejercicio'=>$cierre_ejercicio,
                'objeto_social'=>$objeto_social,
                'razon_social'=>$razon_social,
                'actividad_economica'=>$actividad_economica,
                'domicilio_fiscal'=>$domicilio_fiscal,
                'domicilio_principal'=>$domicilio_principal,
                'origen_capital_efectivo'=>$origen_capital_efectivo,
                'origen_capital_banco'=>$origen_capital_banco,
                'origen_capital_bien'=>$origen_capital_bien,
                //'certificacion_aporte'=>$certificacion_aporte,
                'accionista_otro'=>$accionista_otro,
                'comisario'=>$comisario,
                'fondo_reserva'=>$fondo_reserva,
                'sucursal'=>$sucursal,
                'msgDenominacionComercial'=>$msgDenominacionComercial,
                'msgDocumentoRegistrado'=>$msgDocumentoRegistrado,
                'msgNaturalJuridica'=>$msgNaturalJuridica,
                'msgDuracionEmpresa'=>$msgDuracionEmpresa,
                'msgCierreEjercicio'=>$msgCierreEjercicio,
                'msgObjetoSocial'=>$msgObjetoSocial,
                'msgActividadEconomica'=>$msgActividadEconomica,
                'msgDomicilioFiscal'=>$msgDomicilioFiscal,
                'msgDomicilioPrincipal'=>$msgDomicilioPrincipal,
                'msgRazonSocial'=>$msgRazonSocial,
                'msgOrigenCapital'=>$msgOrigenCapital,
                'msgAccionistaOtro'=>$msgAccionistaOtro,
                'msgComisario'=>$msgComisario,
                'msgSucursal'=>$msgSucursal,
               // 'msgCertificacionAporte'=>$msgCertificacionAporte,
                'msgFondoReserva'=>$msgFondoReserva,
                'msgCapital'=>$msgCapital,
                'boton'=>$boton,
            ]);
         }else{
              return $this->render('resumenacta', [
                'contratista'=>$contratista,
               'natural_juridica'=>$natural_juridica,
                'registro'=>$registro,
                'msgDenominacionComercial'=>$msgDenominacionComercial,
                'msgDocumentoRegistrado'=>$msgDocumentoRegistrado,
                'msgNaturalJuridica'=>$msgNaturalJuridica,
                'msgDuracionEmpresa'=>$msgDuracionEmpresa,
                'msgCierreEjercicio'=>$msgCierreEjercicio,
                'msgObjetoSocial'=>$msgObjetoSocial,
                'msgActividadEconomica'=>$msgActividadEconomica,
                'msgDomicilioFiscal'=>$msgDomicilioFiscal,
                'msgDomicilioPrincipal'=>$msgDomicilioPrincipal,
                'msgRazonSocial'=>$msgRazonSocial,
                'msgOrigenCapital'=>$msgOrigenCapital,
                'msgAccionistaOtro'=>$msgAccionistaOtro,
                'msgComisario'=>$msgComisario,
                'msgSucursal'=>$msgSucursal,
                //'msgCertificacionAporte'=>$msgCertificacionAporte,
                'msgFondoReserva'=>$msgFondoReserva,
                'msgCapital'=>$msgCapital,
                'boton'=>$boton,
            ]);
         }
        
    }
    /**
     * Updates an existing ActasConstitutivas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ActasConstitutivas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ActasConstitutivas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActasConstitutivas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActasConstitutivas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use common\models\p\Domicilios;
use common\models\p\Direcciones;
use common\models\p\Sucursales;
use common\models\p\ContratistasContactos;
use common\models\p\BancosContratistas;
use common\models\p\RelacionesSucursales;
use common\models\p\ActividadesEconomicas;
use common\models\p\DenominacionesComerciales;
use common\models\p\ObjetosEmpresas;
use common\models\p\User;
use common\models\p\ObjetosAutorizaciones;
use app\models\ContratistasSearch;
use common\models\p\Model;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratistasController implements the CRUD actions for Contratistas model.
 */
class ContratistasController extends BaseController
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
     * Lists all Contratistas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratistasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contratistas model.
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
     * Creates a new Contratistas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    
   
    public function actionCreate()
    {
        $model = new Contratistas();
        $model2 = new SysNaturalesJuridicas();
        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            $model2->juridica=true;
            $model2->sys_status=true;
            $model2->save();
            $model->estatus_contratista_id = 1;
            $model->natural_juridica_id = $model2->id;
            $model->save();

            if($model->save()){
                $usuario = User::find(Yii::$app->user->identity->id);
                if($usuario){
                    $usuario->contratista_id = $model->id;
                    if($usuario->save()) {
                        Yii::$app->session->setFlash('success', 'Datos basicos guardados con exito');

                        return $this->redirect(['view', 'id' => $model->id]);
                    }else {
                        Yii::$app->session->setFlash('error', 'No se ha podido guardar el registro');
                    }
                }
            }else{
                Yii::$app->session->setFlash('error', 'No se ha podido guardar el registro');
            }

        }

        return $this->render('create', [
                'model' => $model,
                'model2'=>$model2,
            ]);

    }
    
     public function actionAcordeon()
    {
         $model = new Contratistas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('acordeon');
        }
    }
    
    
    
     public function actionObtenertipopersona($id)
   {
     $contratista = new Contratistas();
     $natural_juridica = new SysNaturalesJuridicas();
        if ($id=='0'){
             $persona_natural = new PersonasNaturales();
             
             
             return $this->renderAjax('personas_naturales', 
                     array('persona_natural' => $persona_natural,
                         'natural_juridica'=> $natural_juridica,
                         
                         ));
         }
         if($id=='1'){
            return $this->renderAjax('personas_juridicas', 
                     array('contratista' => $contratista,
                         'natural_juridica'=> $natural_juridica,
                         
                         ));
         
         }
        
        
         
         
   }
   
   public function actionRaul(){
                
       
       if(isset($_POST['objeto'])){
            $valores=$_POST['objeto'];
            $cantidad= count($valores);
            $objeto_empresa= new ObjetosEmpresas();
             $usuario= User::findOne(Yii::$app->user->identity->id);
             $objeto_empresa->contratista_id= $usuario->contratista_id;
             $objeto_empresa->contratista= true;
             $autorizados = array(); 
             for ($i = 0; $i < $cantidad; $i++) {
       
       
            switch ($valores[$i]) {
                case "PRODUCTOR":
                    $objeto_empresa->productor=true;
                    $elemento = ['PRODUCTOR'=>'PRODUCTOR'];
                    $autorizados[]= $elemento;
                    break;
                case "FABRICANTE":
                    $objeto_empresa->fabricante=true;
                    break;
                case "DISTRIBUIDOR":
                    $objeto_empresa->distribuidor=true;
                    break;
                case "DISTRIBUIDOR AUTORIZADO":
                    $objeto_empresa->distribuidor_autorizado=true;
                    $elemento = ['DISTRIBUIDOR AUTORIZADO'=>'DISTRIBUIDOR AUTORIZADO'];
                    $autorizados[]= $elemento;
                    break;
                case "DISTRIBUIDOR IMPORTADOR":
                    $objeto_empresa->distribuidor_importador=true;
                    break;
                case "DISTRIBUIDOR IMPORTADOR AUTORIZADO":
                     $objeto_empresa->dist_importador_aut=true;
                     $elemento = ['DISTRIBUIDOR IMPORTADOR AUTORIZADO'=>'DISTRIBUIDOR IMPORTADOR AUTORIZADO'];
                     $autorizados[]= $elemento;
                    break;
                case "SERVICIOS BASICOS":
                    $objeto_empresa->servicio_basico=true;
                    break;
                case "SERVICIOS PROFESIONALES":
                    $objeto_empresa->servicio_profesional=true;
                    break;
                case "SERVICIOS COMERCIALES":
                    $objeto_empresa->servicio_comercial=true;
                    break;
                case "SERVICIOS COMERCIALES AUTORIZADO":
                    $objeto_empresa->ser_comercial_aut=true;
                    $elemento = ['SERVICIOS COMERCIALES AUTORIZADO'=>'SERVICIOS COMERCIALES AUTORIZADO'];
                    $autorizados[]= $elemento;
                    break;
                case "FABRICANTE":
                    $objeto_empresa->fabricante=true;
                    break;
                
                
                default:
                    break;
                    }       
        }
        
       
           if(count($autorizados)>=2){
                $objeto_autorizacion = new ObjetosAutorizaciones();
               return $this->renderAjax('_objetos_autorizaciones',
                       array('objeto_autorizacion' => $objeto_autorizacion,
                         'valores'=>$valores
                         ));
           }else{
               if($objeto_empresa->save()){
                   return "datos guardaos";
               }else{
                   return "faltan datos";
               }
               
           }
       }else{
           return "no hay datos";
       }
      
        
       
                
            
			
        
          
   
        
								
    
         
        
   }
    public function actionDatosnatural()
   {
            
        $contratista = new Contratistas();
        $natural_juridica = new SysNaturalesJuridicas();
        $persona_natural = new PersonasNaturales();
       if ($natural_juridica->load(Yii::$app->request->post()) && $persona_natural->load(Yii::$app->request->post())) {
           
      
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->juridica=false;
                $natural_juridica->denominacion = $persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;
               
                if ($natural_juridica->save()) {
                   
                   $persona_natural->rif = $natural_juridica->rif;
                   $persona_natural->sys_pais_id = 1;
                   $persona_natural->nacionalidad = "NACIONAL";
                   $persona_natural->creado_por = 1;
                   if ($persona_natural->save()) {
                       
                       $contratista->estatus_contratista_id = 1;
                       $contratista ->natural_juridica_id = $natural_juridica->id;
                       
                       if($contratista->save()){
                          
                           if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {
                               
                           $usuario->contratista_id = $contratista->id;
                           if ($usuario->save()) {
                              
                               $transaction->commit();
                               $flag = true;
                               return "Datos guardados con mucho exito";
                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();
                             
                           }
                            }
                       else return "guardado con exito";
                       }
                       
                   }else{
                       return "Persona natural no guardada";
                   }
               }else{
                   
                   return "Natural juridica no guardada";
               }
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           
           return "Datos incompleto";
       }
            

        
   }
   
    public function actionDatosjuridica()
   {
            
        $contratista = new Contratistas();
        $natural_juridica = new SysNaturalesJuridicas();
        $persona_juridica = new PersonasJuridicas();
       if ($natural_juridica->load(Yii::$app->request->post()) && $contratista->load(Yii::$app->request->post())) {
           
      
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->juridica=true;
               
               
                if ($natural_juridica->save()) {
                   
                $persona_juridica->rif = $natural_juridica->rif;
                $persona_juridica->razon_social = $natural_juridica->denominacion;
            
                   $persona_juridica->tipo_nacionalidad = "NACIONAL";
                 $persona_juridica->creado_por = 1;
                   if ($persona_juridica->save()) {
                       
                       $contratista->estatus_contratista_id = 1;
                       $contratista ->natural_juridica_id = $natural_juridica->id;
                       
                       if($contratista->save()){
                          
                           if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {
                               
                           $usuario->contratista_id = $contratista->id;
                           if ($usuario->save()) {
                              
                               $transaction->commit();
                               $flag = true;
                               return "Datos guardados con mucho exito";
                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();
                              
                           }
                            }
                       else return "guardado con exito";
                       }
                       
                   }else{
                       return "Persona juridica no guardada";
                   }
               }else{
                   
                   return "Natural juridica no guardada";
               }
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           
           return "Datos incompleto";
       }
            

        
   }
     public function actionDatosbasicos()
   {
     
         
        $model = new Contratistas();
        $naturales_juridicas = new SysNaturalesJuridicas();
        if ($model->load(Yii::$app->request->post()) && $naturales_juridicas->load(Yii::$app->request->post())) {
            $naturales_juridicas->juridica=true;
            $naturales_juridicas->sys_status=true;
            $model2->save();
            $model->estatus_contratista_id = 1;
            $model->natural_juridica_id = $naturales_juridicasdel2->id;
            $model->save();
            
            return "guardado con exito";
        }else{
          

       $model = new Contratistas();
       $model2 = new SysNaturalesJuridicas();


       if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
               $model2->juridica = true;
               $model2->sys_status = true;
               if ($model2->save()) {
                   $model->estatus_contratista_id = 1;
                   $model->natural_juridica_id = $model2->id;
                   if ($model->save()) {
                       if ($usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id)) {
                           $usuario->contratista_id = $model->id;
                           if ($usuario->save()) {
                              
                               $transaction->commit();
                               $flag = true;

                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();
                             
                           }
                       }
                       else return "guardado con exito";
                   }
               }
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }
            

        }
   }
    public function actionDireccionprincipal()
   {
     
         
        $domicilio = new Domicilios();
        $direccion = new Direcciones();
        if ($direccion->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
               if ($direccion->save()) {
                 $domicilio->fiscal=false;
           $domicilio->direccion_id=$direccion->id;
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $domicilio->contratista_id=  $usuario->contratista_id;
                   if ($domicilio->save()) {
                      
                             
                               $transaction->commit();
                               return "Dtos guardados con exito";
                               $flag = true;

                       
                   }else{
                       return "Domicilio no guardado";
                   }
               }else{
                   
                   return "Direccion principal no guardada";
               }
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }
            

        
   }

   
    public function actionPersonacontacto()
   {
     
        $contratista_contacto = new ContratistasContactos();
        $persona_natural  = new PersonasNaturales();
         $natural_juridica  = new SysNaturalesJuridicas();
       
        if ($persona_natural->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->rif= $persona_natural->rif;
            $natural_juridica->juridica= false;
            $natural_juridica->denominacion=$persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;
            $natural_juridica->sys_status=true;
            $natural_juridica->save();
            
                $persona_natural->sys_pais_id = 1;
            $persona_natural->nacionalidad = "NACIONAL";
            $persona_natural->creado_por = 1;
               if ($persona_natural->save()) {
                $contratista_contacto->contacto_id = $persona_natural->id;
          
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $contratista_contacto->contratista_id=  $usuario->contratista_id;
                   if ($contratista_contacto->save()) {
                      
                              
                               $transaction->commit();
                               return "Dtos guardados con exito";
                               $flag = true;

                       
                   }else{
                       return "Datos no guardados";
                   }
               }else{
                   
                   return "Persona de contacto no guardada";
               }
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }
            

        
   }
    public function actionBancocontratista()
   {
          $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $banco_contratista = [new BancosContratistas];
              
           $banco_contratista = Model::createMultiple(BancosContratistas::classname());
            Model::loadMultiple($banco_contratista, Yii::$app->request->post());
            
           
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                
                
                
                foreach ($banco_contratista as $carga_banco) {
                            $carga_banco->contratista_id = $usuario->contratista_id;
                            $carga_banco->save();
                            
                            if (! ($flag = $carga_banco->save(false))) {
                                
                                $transaction->rollBack();
                                return "error en la carga de de datos";
                                break;
                            }
                        }
                
                       
                        $transaction->commit();
                        return "Datos guardados con exito";
               
           } catch (Exception $e) {
               $transaction->rollBack();
           }
            
            
           
   }
   
   
   
   public function actionRelacionsucursal()
   {
            
         $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        $relacion_sucursal = [new RelacionesSucursales];
       $relacion_sucursal = Model::createMultiple(RelacionesSucursales::classname());
            Model::loadMultiple($relacion_sucursal, Yii::$app->request->post());
           
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                foreach ($relacion_sucursal as $carga_sucursal) {
                             $direccion_sucursal = new Direcciones();
                             $natural_juridica = new SysNaturalesJuridicas();
                             $persona_sucursal = new PersonasNaturales();
                             $sucursal= new Sucursales();
                             
                            $direccion_sucursal->sys_estado_id = $carga_sucursal->sys_estado_id;
                            $direccion_sucursal->sys_municipio_id = $carga_sucursal->sys_municipio_id;
                            $direccion_sucursal->sys_parroquia_id = $carga_sucursal->sys_parroquia_id;
                            $direccion_sucursal->zona = $carga_sucursal->zona;
                            $direccion_sucursal->calle = $carga_sucursal->calle;
                            $direccion_sucursal->casa = $carga_sucursal->casa;
                            $direccion_sucursal->nivel = $carga_sucursal->nivel;                         
                            $direccion_sucursal->numero = $carga_sucursal->numero;
                            $direccion_sucursal->referencia = $carga_sucursal->referencia;

                             if (! ($flag = $direccion_sucursal->save(false))) {
                                
                                $transaction->rollBack();
                                return "error en la carga de de datos de direcciones";
                                break;
                            }
                             
                            
                              $natural_juridica->rif= $carga_sucursal->rif;
                              $natural_juridica->juridica= false;
                              $natural_juridica->denominacion=$carga_sucursal->primer_nombre.' '.$carga_sucursal->primer_apellido;
                              $natural_juridica->sys_status=true;
                              
                            if (! ($flag = $natural_juridica->save(false))) {
                                
                                $transaction->rollBack();
                                return "error en la carga de la persona natural";
                                break;
                            }
                            
                            $persona_sucursal->rif= $carga_sucursal->rif;
                            $persona_sucursal->primer_nombre= $carga_sucursal->primer_nombre;
                            $persona_sucursal->segundo_nombre= $carga_sucursal->segundo_nombre;
                            $persona_sucursal->primer_apellido= $carga_sucursal->primer_apellido;
                            $persona_sucursal->segundo_apellido= $carga_sucursal->segundo_apellido;
                            $persona_sucursal->telefono_local= $carga_sucursal->telefono_local;
                            $persona_sucursal->telefono_celular= $carga_sucursal->telefono_celular;
                            $persona_sucursal->fax= $carga_sucursal->fax;
                            $persona_sucursal->correo= $carga_sucursal->correo;
                            $persona_sucursal->pagina_web= $carga_sucursal->pagina_web;
                            $persona_sucursal->facebook= $carga_sucursal->facebook;
                            $persona_sucursal->twitter= $carga_sucursal->twitter;
                            $persona_sucursal->instagram= $carga_sucursal->instagram;
            
                            $persona_sucursal->sys_pais_id = 1;
                            $persona_sucursal->nacionalidad = "NACIONAL";
                            $persona_sucursal->creado_por = 1;
                            
                            if (! ($flag =  $persona_sucursal->save(false))) {
                                
                                $transaction->rollBack();
                                return "error en la carga de la persona de contacto";
                            }
                            
                            $sucursal->representante= $carga_sucursal->representante;
                            $sucursal->accionista= $carga_sucursal->accionista;
                            $sucursal->persona_natural_id= $persona_sucursal->id;
                            $sucursal->direccion_id= $direccion_sucursal->id;
                            $sucursal->contratista_id= $usuario->contratista_id;
                             if (! ($flag =   $sucursal->save(false))) {
                                
                                $transaction->rollBack();
                                return "error en la carga de la sucursal";
                            }
                        }
                        Yii::$app->session->setFlash('success', 'Datos bancos guardados con exito');
                        $transaction->commit();
                        return "Datos guardados con exito";
                        
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }
   
       
       
       public function actionActividadeconomica()
   {
     
         
        $actividad_economica = new ActividadesEconomicas();
      
        if ($actividad_economica->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                
               
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $actividad_economica->contratista_id=  $usuario->contratista_id;
                   if ( $actividad_economica->save()) {
                      
                             
                               $transaction->commit();
                               return "Datos guardados con exito";
                               $flag = true;

                       
                   }else{
                       return "Actividades economicas no guardadas";
                   }
               
               
               if(!$flag)
               {
                   $transaction->rollBack();
               }
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }
            

        
   }
   
    public function actionDenominacion()
   {
     $denominacion_comercial = new DenominacionesComerciales();
      $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
    if ($denominacion_comercial->load(Yii::$app->request->post())) {
         $denominacion_comercial->contratista_id = $usuario->contratista_id;
        if($denominacion_comercial->tipo_denominacion == "PERSONA NATURAL" || $denominacion_comercial->tipo_denominacion =="FIRMA PERSONAL" || $denominacion_comercial->tipo_denominacion == "SOCIEDAD DE RESPONSABILIDAD LIMITADA" || $denominacion_comercial->tipo_denominacion== "COMPAÑIA NOMBRE COLECTIVO" || $denominacion_comercial->tipo_denominacion == "COMPAÑIA ANONIMA"){
           
            if($denominacion_comercial->save()){
                return "Datos guardados con exito";
            }else{
                return "Faltan datos por guardar";
            }
            
        }else{
            
            
         switch ($denominacion_comercial->tipo_denominacion) {
                case "SOCIEDAD ANONIMA":
                    return $this->renderAjax('_sociedades_anonimas', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                case "COMANDITA":
                     return $this->renderAjax('_comanditas', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                case "FUNDACION":
                     return $this->renderAjax('_fundaciones', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                case "ORGANIZACION SOCIOPRODUCTIVA":
                     return $this->renderAjax('_org_socioproductivas', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                case "COOPERATIVA":
                     return $this->renderAjax('_cooperativas', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                case "EMPRESA EXTRANJERA":
                     return $this->renderAjax('_empresas_extranjeras', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                 case "ASOCIACION CIVIL":
                     return $this->renderAjax('_asociedades_civiles', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                 case "SOCIEDAD CIVIL":
                     return $this->renderAjax('_asociedades_civiles', 
                     array('d_comercial' => $denominacion_comercial,));
                    break;
                default:
                            return "Debe elegir una opcion";
                    }
           
        }
        
        
        
    }else{
    return "Datos incompletos";
    }
      
        
        
         
         
   }
   
    public function actionDenominacioncomercial()
   {
     $denominacion_comercial = new DenominacionesComerciales();
     
     if ($denominacion_comercial->load(Yii::$app->request->post())) {
         
         if($denominacion_comercial->tipo_subdenominacion!=null && $denominacion_comercial->tipo_denominacion!="COOPERATIVA" ){
             
               if($denominacion_comercial->tipo_denominacion=="ORGANIZACION SOCIOPRODUCTIVA" && $denominacion_comercial->codigo_situr==null){
              return "Faltan datos debe ingresar el codigo situr";
            }else{
            if($denominacion_comercial->save()){
                return "Datos guardados con exito";
            }else{
                return "Faltan datos por guardar";
            }
         
            }
         }else{
             
             if($denominacion_comercial->tipo_denominacion=="COOPERATIVA" ){
                 
                 if($denominacion_comercial->cooperativa_capital==null || $denominacion_comercial->cooperativa_distribuicion ==  null){
                      return "Faltan datos debe competar los campos";
                 }else{
                     if($denominacion_comercial->save()){
                            return "Datos guardados con exito";
                        }else{
                        return "Faltan datos por guardar";
                        }
                 }
             }else{
                 
                 return "eror fuera de orbita";
             }
         }
       
     }else{
         return "Datos incorrectos";
     }
         
   }
    /**
     * Updates an existing Contratistas model.
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
     * Deletes an existing Contratistas model.
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
     * Finds the Contratistas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contratistas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contratistas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

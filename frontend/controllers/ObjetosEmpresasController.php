<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ObjetosEmpresas;
use common\models\p\User;
use common\models\p\Model;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasJuridicas;
use common\models\p\ObjetosAutorizaciones;
use common\models\p\RelacionesObjetos;
use app\models\ObjetosEmpresasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosEmpresasController implements the CRUD actions for ObjetosEmpresas model.
 */
class ObjetosEmpresasController extends BaseController
{
    public function behaviors()
    {
        return array_merge(parent::behaviors(),[
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all ObjetosEmpresas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetosEmpresasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ObjetosEmpresas model.
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
     * Creates a new ObjetosEmpresas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ObjetosEmpresas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
      public function actionCrearobjeto()
    {
        $objeto_empresa = new ObjetosEmpresas();
        return $this->render('_objetos_empresas',['objeto_empresa' => $objeto_empresa]);
    }
     public function actionObjetoautorizacion(){
       
   
       $objeto_empresa = new ObjetosEmpresas();
        $relacion_objeto = [new RelacionesObjetos];
       $relacion_objeto = Model::createMultiple(RelacionesObjetos::classname());
            Model::loadMultiple($relacion_objeto, Yii::$app->request->post());
            if($objeto_empresa->load(Yii::$app->request->post())){
               
           $transaction = \Yii::$app->db->beginTransaction();
           
           
           
           if($objeto_empresa->distribuidor_autorizado==null){
               
               $objeto_empresa->distribuidor_autorizado=false;
           }
            if($objeto_empresa->dist_importador_aut==null){
              
                $objeto_empresa->dist_importador_aut=false;
           }
            if($objeto_empresa->ser_comercial_aut==null){
                $objeto_empresa->ser_comercial_aut=false;
           }
            if($objeto_empresa->productor==null){
               
               $objeto_empresa->productor=false;
           }
            if($objeto_empresa->fabricante==null){
              
                $objeto_empresa->fabricante=false;
           }
            if($objeto_empresa->fabricante_importado==null){
                
                $objeto_empresa->fabricante_importado=false;
           }
             if($objeto_empresa->distribuidor==null){
               
               $objeto_empresa->distribuidor=false;
           }
            if($objeto_empresa->distribuidor_importador==null){
              
                $objeto_empresa->distribuidor_importador=false;
           }
            if($objeto_empresa->servicio_basico==null){
                $objeto_empresa->servicio_basico=false;
           }
           if($objeto_empresa->servicio_profesional==null){
                $objeto_empresa->servicio_profesional=false;
           }
           if($objeto_empresa->servicio_comercial==null){
                $objeto_empresa->servicio_comercial=false;
           }
            if($objeto_empresa->obra==null){
                $objeto_empresa->obra=false;
           }
           
           $distribuidor=-1;
           $importador=-1;
           $servicio=-1;
           if($objeto_empresa->distribuidor_autorizado==1){
               
                $distribuidor=0;
           }
            if($objeto_empresa->dist_importador_aut==1){
              
                $importador=0;
           }
            if($objeto_empresa->ser_comercial_aut==1){
                $servicio=0;
           }
          
            foreach ($relacion_objeto as $carga) {
               echo $carga->tipo_objeto;
                switch ($carga->tipo_objeto){
                    
                    case "DISTRIBUIDOR AUTORIZADO":
                        $distribuidor=true;
                        break;
                    case "DISTRIBUIDOR IMPORTADOR AUTORIZADO":
                        $importador=true;
                        break;
                    case "SERVICIOS COMERCIALES AUTORIZADO";
                        $servicio=true;
                        break;
                    default :
                        break;
                }
            }
           try {
             
               
               if($distribuidor==0 || $servicio==0 || $importador==0){
                   return "datos incompletos faltaron rellenar campos del tipo autorizacion";
               }else{
                
                     if (! ($flag = $objeto_empresa->save())) {

                                            $transaction->rollBack();
                                            return "faltan datos del objeto empresa";
                                          
                                    }
                   
                    }
              
               
                foreach ($relacion_objeto as $carga_objeto) {
                            
                             $natural_juridica = new SysNaturalesJuridicas();
                             $persona_juridica = new PersonasJuridicas();
                             $objeto_autorizacion= new ObjetosAutorizaciones();
                             
                             if($carga_objeto->domicilio_fabricante_id==1){
                                 
                                 $natural_juridica->rif = $carga_objeto->numero_identificacion;
                                 $natural_juridica->denominacion= $carga_objeto->denominacion;
                                 $natural_juridica->juridica=true;
                                  if (! ($flag = $natural_juridica->save())) {

                                            $transaction->rollBack();
                                            return "faltan datos natural juridica";
                                            break;
                                    }
                                     
                                     $persona_juridica->rif=$natural_juridica->rif;
                                     $persona_juridica->razon_social=$natural_juridica->denominacion;
                                     $persona_juridica->tipo_nacionalidad="NACIONAL";
                                     $persona_juridica->creado_por=1;
                                    if (! ($flag = $persona_juridica->save())) {

                                        $transaction->rollBack();
                                    return "faltan datos de persona juridica";
                                            break;
                                    }
                                 
                             }else{
                                   
                                     $persona_juridica->numero_identitifacion=$carga_objeto->numero_identificacion;
                                     $persona_juridica->razon_social=$carga_objeto->denominacion;
                                     $persona_juridica->tipo_nacionalidad="EXTRANJERA";
                                     $persona_juridica->creado_por=1;
                                     if (! ($flag = $persona_juridica->save())) {

                                        $transaction->rollBack();
                                    return "faltan datos de persona juridica extranjera";
                                            break;
                                    }
                             }
                             
                            $objeto_autorizacion->domicilio_fabricante_id= $carga_objeto->domicilio_fabricante_id;
                            $objeto_autorizacion->productos= $carga_objeto->productos;
                             $objeto_autorizacion->marcas= $carga_objeto->marcas;
                             $objeto_autorizacion->origen_producto_id= $carga_objeto->origen_producto_id;
                             $objeto_autorizacion->sello_firma= $carga_objeto->sello_firma;
                             $objeto_autorizacion->idioma_redacion_id= $carga_objeto->idioma_redaccion_id;
                             $objeto_autorizacion->documento_traducido= $carga_objeto->documento_traducido;
                             $objeto_autorizacion->numero_identificacion= $carga_objeto->traductor_identificacion;
                             $objeto_autorizacion->nombre_interprete= $carga_objeto->nombre_interprete;
                             $objeto_autorizacion->fecha_emision= $carga_objeto->fecha_emision;
                             $objeto_autorizacion->fecha_vencimiento= $carga_objeto->fecha_vencimiento;
                             $objeto_autorizacion->tipo_objeto= $carga_objeto->tipo_objeto;
                             $objeto_autorizacion->persona_juridica_id= $persona_juridica->id;
                              $objeto_autorizacion->objeto_empresa_id= $objeto_empresa->id;
                             if (! ($flag =   $objeto_autorizacion->save(false))) {

                                $transaction->rollBack();
                                return "error en la carga de las autorizaciones";
                            }
                        }
                      
                        $transaction->commit();
                        return "Datos guardados con exito";

           } catch (Exception $e) {
               $transaction->rollBack();
           }
           
            }
   }

   public function actionObjetoempresa(){


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
                    break;
                case "FABRICANTE":
                    $objeto_empresa->fabricante=true;
                    break;
                case "FABRICANTE IMPORTADOR":
                    $objeto_empresa->fabricante_importado=true;
                    break;
                case "DISTRIBUIDOR":
                    $objeto_empresa->distribuidor=true;
                    break;
                case "DISTRIBUIDOR AUTORIZADO":
                    $objeto_empresa->distribuidor_autorizado=true;

                    $autorizados['DISTRIBUIDOR AUTORIZADO']= 'DISTRIBUIDOR AUTORIZADO';
                    //array_push($autorizados,$elemento);
                    break;
                case "DISTRIBUIDOR IMPORTADOR":
                    $objeto_empresa->distribuidor_importador=true;
                    break;
                case "DISTRIBUIDOR IMPORTADOR AUTORIZADO":
                     $objeto_empresa->dist_importador_aut=true;

                     $autorizados['DISTRIBUIDOR IMPORTADOR AUTORIZADO']= 'DISTRIBUIDOR IMPORTADOR AUTORIZADO';
                       //array_push($autorizados,$elemento);
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

                    $autorizados['SERVICIOS COMERCIALES AUTORIZADO']= 'SERVICIOS COMERCIALES AUTORIZADO';
                     //array_push($autorizados,$elemento);
                    break;
                case "FABRICANTE":
                    $objeto_empresa->fabricante=true;
                    break;


                default:
                    break;
                    }
        }


           if(count($autorizados)){
                
               return $this->renderAjax('_relaciones_objetos',
                       array('relacion_objeto' => (empty($relacion_objeto)) ? [new RelacionesObjetos()] : $relacion_objeto,
                         'objeto_empresa'=>$objeto_empresa,
                         'autorizado'=>$autorizados
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
    /**
     * Updates an existing ObjetosEmpresas model.
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
     * Deletes an existing ObjetosEmpresas model.
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
     * Finds the ObjetosEmpresas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObjetosEmpresas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObjetosEmpresas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

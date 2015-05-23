<?php

namespace frontend\controllers;

use Yii;
use common\models\p\DenominacionesComerciales;
use common\models\p\User;
use app\models\DenominacionesComercialesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DenominacionesComercialesController implements the CRUD actions for DenominacionesComerciales model.
 */
class DenominacionesComercialesController extends BaseController
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
     * Lists all DenominacionesComerciales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DenominacionesComercialesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DenominacionesComerciales model.
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
     * Creates a new DenominacionesComerciales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DenominacionesComerciales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
     public function actionCreardenominacion()
    {
        $denominacion_comercial = new DenominacionesComerciales();
        
        $usuario= User::findOne(Yii::$app->user->identity->id);
        $id_contratista = $usuario->contratista_id;
        return $this->render('_denominaciones_comerciales',['denominacion_comercial' => $denominacion_comercial,
                                                                      'id_contratista'=>$id_contratista]);

    }
    
    
     public function actionDenominacion()
   {
     $denominacion_comercial = new DenominacionesComerciales();
      $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
    if ($denominacion_comercial->load(Yii::$app->request->post())) {
         $denominacion_comercial->contratista_id = $usuario->contratista_id;
        if($denominacion_comercial->tipo_denominacion == "PERSONA NATURAL" || $denominacion_comercial->tipo_denominacion =="FIRMA PERSONAL" || $denominacion_comercial->tipo_denominacion == "SOCIEDAD DE RESPONSABILIDAD LIMITADA" || $denominacion_comercial->tipo_denominacion== "COMPAÑIA NOMBRE COLECTIVO" || $denominacion_comercial->tipo_denominacion == "COMPAÑIA ANONIMA"){
              
       $denominaciones= DenominacionesComerciales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id]);

            
            if(isset($denominaciones)){
                   
                      return "Usario ya posee una denominacion comercial asociada";
                                   
                               
                   }
            if($denominacion_comercial->save()){
                return $this->redirect(['index']);
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
                
                 $denominaciones= DenominacionesComerciales::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id]);

            
            if(isset($denominaciones)){
                   
                      return "Usario ya posee una denominacion comercial asociada";
                                   
                               
                   }
                
            if($denominacion_comercial->save()){
                return $this->redirect(['index']);
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
                             return $this->redirect(['index']);
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
     * Updates an existing DenominacionesComerciales model.
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
     * Deletes an existing DenominacionesComerciales model.
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
     * Finds the DenominacionesComerciales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DenominacionesComerciales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DenominacionesComerciales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

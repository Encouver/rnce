<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use common\models\p\Domicilios;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\DomiciliosSearch;
use common\models\p\Direcciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DomiciliosController implements the CRUD actions for Domicilios model.
 */
class DomiciliosController extends BaseController
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
     * Lists all Domicilios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModelFiscal = new DomiciliosSearch();
        $searchModelFiscal->fiscal = true;
          $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModelFiscal->documento_registrado_id= $documento->id;
        }
        $dataProviderFiscal = $searchModelFiscal->search(Yii::$app->request->queryParams);
        $searchModelPrincipal = new DomiciliosSearch();
        $searchModelPrincipal->fiscal = false;
         if(isset($documento)){
            $searchModelPrincipal->documento_registrado_id= $documento->id;
        }
        $dataProviderPrincipal = $searchModelPrincipal->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModelFiscal' => $searchModelFiscal,
            'dataProviderFiscal' => $dataProviderFiscal,
            'searchModelPrincipal' => $searchModelPrincipal,
            'dataProviderPrincipal' => $dataProviderPrincipal,
        ]);
    }
     public function actionModificacion()
    {
        $searchModelFiscal = new DomiciliosSearch();
        $searchModelFiscal->fiscal = true;
        $documento=$searchModelFiscal->Modificacionactual();
        if(isset($documento)){
            $searchModelFiscal->documento_registrado_id= $documento->documento_registrado_id;
          
        }
      
        $dataProviderFiscal = $searchModelFiscal->search(Yii::$app->request->queryParams);
        $searchModelPrincipal = new DomiciliosSearch();
        $searchModelPrincipal->fiscal = false;
         if(isset($documento)){
            $searchModelPrincipal->documento_registrado_id= $documento->documento_registrado_id;
          
        }
        $dataProviderPrincipal = $searchModelPrincipal->search(Yii::$app->request->queryParams);

        return $this->render('modificacion', [
            'searchModelFiscal' => $searchModelFiscal,
            'dataProviderFiscal' => $dataProviderFiscal,
            'searchModelPrincipal' => $searchModelPrincipal,
            'dataProviderPrincipal' => $dataProviderPrincipal,
            'documento'=>$documento
        ]);
    }


    /**
     * Displays a single Domicilios model.
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
     * Creates a new Domicilios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id=null)
    {
     
        $direccion = new Direcciones();
         $model = new Domicilios();
         if (!is_null($id)){
            switch ($id){
            case "principal":
                $direccion->scenario=$id;
                $model->fiscal=false;
                break;
            case "fiscal":
                 $model->fiscal=true;
                break;
            default :
                break;
            }  
        }
         if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario ya posse una direccion asociada ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        if ($model->load(Yii::$app->request->post()) && $direccion->load(Yii::$app->request->post())) {
              $transaction = \Yii::$app->db->beginTransaction();
           try {
              
               if ($direccion->save()) {
           $model->direccion_id=$direccion->id;
           
                   if ($model->save()) {


                               $transaction->commit();
                               if($model->documentoRegistrado->tipo_documento_id==2){
                                   return $this->redirect(['modificacion']);
                               }
                                return $this->redirect(['index']);
                              


                   }else{
                        $transaction->rollBack();
                       Yii::$app->session->setFlash('error','Direccion Principal no guardada');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
                   }
               }else{
                   $transaction->rollBack();
                   Yii::$app->session->setFlash('error','Error en la carga de la direccion');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
               }

           } catch (Exception $e) {
               $transaction->rollBack();
           }
         
           
            
           
        } else {
            return $this->render('create', [
                'model'=>$model,
                'direccion' => $direccion,
            ]);
        }
    }
    
    

    /**
     * Updates an existing Domicilios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $direccion = Direcciones::findOne($model->direccion_id);
        if($model->fiscal==null){
            $direccion->scenario='principal';
            $model->fiscal=false;
        }else{
            $model->fiscal=true;
        }
        if ($model->load(Yii::$app->request->post()) && $direccion->load(Yii::$app->request->post())) {
            if($direccion->save()){
                 if($model->documentoRegistrado->tipo_documento_id==2){        
                    return $this->redirect(['modificacion']);
                }
                  return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error', 'Error en la carga de la direccion');
                return $this->render('update', [
                'model'=>$model,
                'direccion' => $direccion,
            ]);
            
                
            }
          
        } 
        return $this->render('update', [
                'model'=>$model,
                'direccion' => $direccion,
            ]);
        
    }

    /**
     * Deletes an existing Domicilios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
       if($model->documentoRegistrado->tipo_documento_id==2){
            $model->delete();          
             return $this->redirect(['modificacion']);
        }
         $model->delete();                    

        return $this->redirect(['index']);
    }

    /**
     * Finds the Domicilios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Domicilios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Domicilios::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

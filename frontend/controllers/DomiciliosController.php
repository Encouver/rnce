<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Domicilios;
use app\models\DomiciliosSearch;
use common\models\p\Direcciones;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DomiciliosController implements the CRUD actions for Domicilios model.
 */
class DomiciliosController extends Controller
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
        $dataProviderFiscal = $searchModelFiscal->search(Yii::$app->request->queryParams);
        $searchModelPrincipal = new DomiciliosSearch();
        $searchModelPrincipal->fiscal = false;
        $dataProviderPrincipal = $searchModelPrincipal->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModelFiscal' => $searchModelFiscal,
            'dataProviderFiscal' => $dataProviderFiscal,
            'searchModelPrincipal' => $searchModelPrincipal,
            'dataProviderPrincipal' => $dataProviderPrincipal,
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
                                $flag = true;
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
        $this->findModel($id)->delete();

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

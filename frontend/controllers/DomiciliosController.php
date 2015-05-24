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
        $searchModel = new DomiciliosSearch();
        $searchModel->fiscal = false;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
        if ($model->load(Yii::$app->request->post()) && $direccion->load(Yii::$app->request->post())) {
              $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
               if ($direccion->save()) {
           $model->direccion_id=$direccion->id;
           $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
            $model->contratista_id=  $usuario->contratista_id;
             $domicilio= Domicilios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'fiscal'=>false]);
            if($model->fiscal){
                 $domicilio= Domicilios::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'fiscal'=>true]);
            }
            

            
            if(isset($domicilio)){
                   $opcion="Principal";
                   if($domicilio->fiscal){
                       $opcion="Fiscal";
                   }
                      Yii::$app->session->setFlash('error','Usuario ya posee una direccion '.$opcion.' asociada');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
                   }
                   if ($model->save()) {


                               $transaction->commit();
                                $flag = true;
                                return $this->redirect(['index']);
                              


                   }else{
                       Yii::$app->session->setFlash('error','Direccion Principal no guardada');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
                   }
               }else{
                   Yii::$app->session->setFlash('error','Error en la carga de la direccion');
                   return $this->render('create', [
                        'model'=>$model,
                        'direccion' => $direccion,
                        ]);
               }

               if(!$flag)
               {
                   $transaction->rollBack();
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
   
    public function actionCrearprincipal()
    {
        $direccion = new Direcciones();

        return $this->render('_direcciones_principales',['direccion' => $direccion]);
            
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

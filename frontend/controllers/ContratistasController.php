<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use app\models\ContratistasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratistasController implements the CRUD actions for Contratistas model.
 */
class ContratistasController extends Controller
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
    
    public function actionRaul()
    {
        
   
     $natural_juridica = new SysNaturalesJuridicas();
        
             $persona_natural = new PersonasNaturales();
             
           
             return $this->render('personas_naturales', 
                     array('persona_natural' => $persona_natural,
                         'natural_juridica'=> $natural_juridica,
      
                         ));
             
            // if$model->validate()
                 
              
         
        
    }
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
    
     public function actionAcordion()
    {
         $model = new Contratistas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('acordion');
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
                         'contratista'=> $contratista,
                         ));
             
            // if$model->validate()
                 
              
         }else{
         
         }
        
        
         
         
   }
    public function actionDatosnatural()
   {
        
   }
     public function actionDatosbasicos()
   {
       return "hola mundo";
         
      /*   $model = new Contratistas();
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
                               Yii::$app->session->setFlash('success', 'Datos basicos guardados con exito');
                               $transaction->commit();
                               $flag = true;

                               //return $this->redirect(['view', 'id' => $model->id]);
                           } else {
                               $transaction->rollBack();
                               Yii::$app->session->setFlash('error', 'No se ha podido guardar el registro');
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
            

        }*/
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

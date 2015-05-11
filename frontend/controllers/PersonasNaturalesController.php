<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PersonasNaturales;
use app\models\PersonasNaturalesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonasNaturalesController implements the CRUD actions for PersonasNaturales model.
 */
class PersonasNaturalesController extends Controller
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
     * Lists all PersonasNaturales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonasNaturalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonasNaturales model.
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
     * Creates a new PersonasNaturales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonasNaturales();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
     public function actionCrearpersonanatural()
    {
        $persona_natural = new PersonasNaturales();
        $natural_juridica= new \common\models\p\SysNaturalesJuridicas();
        

        if ($persona_natural->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->rif= $persona_natural->numero_identificacion;
            $natural_juridica->juridica= false;
            $natural_juridica->denominacion=$persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;
            $natural_juridica->sys_status=true;
            if (! ($flag = $natural_juridica->save(false))) {

                                        $transaction->rollBack();
                                    return "faltan datos de natural juridica";
                                            
                                    }
                                     
                                     
            if($persona_natural->sys_pais_id==1){
                $persona_natural->rif=$persona_natural->numero_identificacion;
                $persona_natural->numero_identificacion=null;
                $persona_natural->nacionalidad = "NACIONAL";
            }else{
                 $persona_natural->nacionalidad = "EXTRANJERA";
            }

           
           
            $persona_natural->creado_por = 1;
               if ($persona_natural->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }


    }
       public function actionCrearcomisario()
    {
        $persona_natural = new PersonasNaturales();
        $natural_juridica= new \common\models\p\SysNaturalesJuridicas();
        

        if ($persona_natural->load(Yii::$app->request->post())) {
           $transaction = \Yii::$app->db->beginTransaction();
           try {
                $flag =false;
                $natural_juridica->rif= $persona_natural->rif;
            $natural_juridica->juridica= false;
            $natural_juridica->denominacion=$persona_natural->primer_nombre.' '.$persona_natural->primer_apellido;
            $natural_juridica->sys_status=true;
            if (! ($flag = $natural_juridica->save(false))) {

                                        $transaction->rollBack();
                                    return "faltan datos de natural juridica";
                                            
                                    }
              $persona_natural->sys_pais_id=1;                       
              $persona_natural->nacionalidad = "NACIONAL";
                 

           
           
            $persona_natural->creado_por = 1;
            $persona_natural->save();
           
               if ($persona_natural->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
       }else{
           return "Datos incompletos";
       }


    }
    /**
     * Updates an existing PersonasNaturales model.
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
     * Deletes an existing PersonasNaturales model.
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
     * Finds the PersonasNaturales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonasNaturales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonasNaturales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

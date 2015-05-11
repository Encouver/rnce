<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ContratistasContactos;
use common\models\p\PersonasNaturales;
use common\models\p\SysNaturalesJuridicas;
use app\models\ContratistasContactosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratistasContactosController implements the CRUD actions for ContratistasContactos model.
 */
class ContratistasContactosController extends Controller
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
     * Lists all ContratistasContactos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratistasContactosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContratistasContactos model.
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
     * Creates a new ContratistasContactos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContratistasContactos();
        $model2  = new PersonasNaturales();
        $model3  = new SysNaturalesJuridicas();

        if ($model2->load(Yii::$app->request->post())) {
            
            $model3->rif= $model2->rif;
            $model3->juridica= false;
            $model3->denominacion=$model2->primer_nombre.' '.$model2->primer_apellido;
            $model3->sys_status=true;
            $model3->save();
            
            
            $model2->sys_pais_id = 1;
            $model2->nacionalidad = "NACIONAL";
            $model2->creado_por = 1;
            
            
            
            $model2->save();
            $model->contacto_id = $model2->id;
            $model->contratista_id = 1;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2' => $model2,
            ]);
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
   
   
   public function actionCrearcontacto()
           
    {
        $persona_natural = new PersonasNaturales();
        return $this->render('_personas_contactos',['persona_natural' => $persona_natural]);
    }
   
    /**
     * Updates an existing ContratistasContactos model.
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
     * Deletes an existing ContratistasContactos model.
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
     * Finds the ContratistasContactos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContratistasContactos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContratistasContactos::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

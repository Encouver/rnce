<?php

namespace frontend\controllers;

use Yii;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
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
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'model2'=>$model2,
            ]);
        }
    }
    
     public function actionAcordion()
    {
         $model = new Contratistas();
        $model2 = new SysNaturalesJuridicas();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('acordion', [
                'model' => $model,
                'model2'=>$model2,
            ]);
        }
    }

     public function actionDatos($id)
   {
         echo "hola";
         
   }
     public function actionDatosbasicos()
   {
        //$model = new Contratistas();
         //$model2 = new SysNaturalesJuridicas();
        //Yii::$app->session->setFlash('success', 'Si llego a la funcion');
        
        //return $this->renderAjax('_form');
      /* return $this->render('acordion', [
               'model' => $model,
               'model2'=>$model2,
           ]);*/
          /* Yii::$app->response->format = Response::FORMAT_JSON;
           $res = array(
            'body'    => date('Y-m-d H:i:s'),
            'success' => true,
        );
 
        return $res;*/
        echo "ohoao";
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

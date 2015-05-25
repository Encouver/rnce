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

        if ($model->load(Yii::$app->request->post()) ) {
         
            $model->contratista_id=  Yii::$app->user->identity->contratista_id;
            $contacto= ContratistasContactos::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id]);
            if(isset($contacto)){
                 Yii::$app->session->setFlash('error','Usuario ya posse una persona de contacto asociada');
                       return $this->render('create', [
                'model' => $model,
            ]);
            }
            if('')
                   if ($model->save()) {
                return $this->redirect(['index']);


                   }else{
                       Yii::$app->session->setFlash('error','Error en la carga');
                       return $this->render('create', [
                'model' => $model,
            ]);
                   }
            
           
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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

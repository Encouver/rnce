<?php

namespace frontend\controllers;

use Yii;
use common\models\p\EmpresasRelacionadas;
use app\models\EmpresasRelacionadasSearch;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use common\models\a\ActivosDocumentosRegistrados;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmpresasRelacionadasController implements the CRUD actions for EmpresasRelacionadas model.
 */
class EmpresasRelacionadasController extends BaseController
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
     * Lists all EmpresasRelacionadas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmpresasRelacionadasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EmpresasRelacionadas model.
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
     * Creates a new EmpresasRelacionadas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmpresasRelacionadas();
        $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
        $modelJuridica= new PersonasJuridicas();
        $modelDocumento= new ActivosDocumentosRegistrados();

        if ($model->load(Yii::$app->request->post())) {
             $valores=$model->objeto_empresa;
            $cantidad= count($valores);
         
            $resultado="";
             for ($i = 0; $i < $cantidad; $i++) {
                 if($i==0){
                     $resultado=$valores[$i];
                 }else{
                     $resultado=$resultado.','.$valores[$i];
                 }
                  
             }
            $model->objeto_empresa=$resultado;
           
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
                'modelDocumento'=>$modelDocumento,
            ]);
        }
    }

    /**
     * Updates an existing EmpresasRelacionadas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
         $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
        $modelJuridica= new PersonasJuridicas();
        $modelDocumento= new ActivosDocumentosRegistrados();
        if ($model->load(Yii::$app->request->post())) {
           $valores=$model->objeto_empresa;
            $cantidad= count($valores);
         
            $resultado="";
             for ($i = 0; $i < $cantidad; $i++) {
                 if($i==0){
                     $resultado=$valores[$i];
                 }else{
                     $resultado=$resultado.','.$valores[$i];
                 }
                  
             }
            $model->objeto_empresa=$resultado;
           
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
                'modelDocumento'=>$modelDocumento,
            ]);
        }
    }

    /**
     * Deletes an existing EmpresasRelacionadas model.
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
     * Finds the EmpresasRelacionadas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmpresasRelacionadas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmpresasRelacionadas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

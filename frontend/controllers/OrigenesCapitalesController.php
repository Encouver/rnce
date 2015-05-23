<?php

namespace frontend\controllers;

use Yii;
use common\models\p\OrigenesCapitales;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\OrigenesCapitalesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrigenesCapitalesController implements the CRUD actions for OrigenesCapitales model.
 */
class OrigenesCapitalesController extends BaseController
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
     * Lists all OrigenesCapitales models.
     * @return mixed
     */
    public function actionIndex()
    {
       $searchModel = new OrigenesCapitalesSearch();
         $searchModel->efectivo = true;
        $dataProvider_efectivo = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = true;
        $dataProvider_banco = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = true;
        $dataProvider_bien = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'dataProvider_efectivo' => $dataProvider_efectivo,
            'dataProvider_banco' => $dataProvider_banco,
            'dataProvider_bien' => $dataProvider_bien,
        ]);
    }
    public function actionOrigen()
    {
       $searchModel = new OrigenesCapitalesSearch();
         $searchModel->efectivo = true;
        $dataProvider_efectivo = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = true;
        $dataProvider_banco = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->efectivo = false;
        $searchModel->banco = false;
        $searchModel->bien = true;
        $dataProvider_bien = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('origen_capital', [
            'dataProvider_efectivo' => $dataProvider_efectivo,
            'dataProvider_banco' => $dataProvider_banco,
            'dataProvider_bien' => $dataProvider_bien,
        ]);
    }

    /**
     * Displays a single OrigenesCapitales model.
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
     * Creates a new OrigenesCapitales model.
     * @param integer $identificador
     * @return mixed
     */
    public function actionCreate($identificador=null)
    {
    
        $model = new OrigenesCapitales();
        if (!is_null($identificador)){
            switch ($identificador){
            case "efectivo":
                $model->scenario=$identificador;
                $model->efectivo=true;
                break;
            case "banco":
                $model->scenario=$identificador;
                $model->banco=true;
                break;
            case "bien":
                $model->scenario=$identificador;
                $model->bien=true;
                break;
            default :
                break;
            }  
        }

        if ($model->load(Yii::$app->request->post())) {
           
              
                     
              
                    $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                    $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                    $model->contratista_id=$usuario->contratista_id;
                    
                    $model->documento_registrado_id=$registro->id;
                    
                    if($model->save()){
                        return $this->redirect(['index']);
                    }else{
                       
             
                        return $this->render('create', [
                            'model' => $model,
                            ]);
                    }
                    
                     
            }else{
                
                        return $this->render('create', [
                            'model' => $model,
                            ]);
            }
    }
    
    
    
   

    /**
     * Updates an existing OrigenesCapitales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
       
           if($model->efectivo){
               $model->scenario='efectivo';
           }else{
               
               if($model->banco){
               $model->scenario='banco';
                }else{
                    if($model->bien){
                        $model->scenario='bien';
                    }else{
               
               
                    }
                    
                }
           }
        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrigenesCapitales model.
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
     * Finds the OrigenesCapitales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OrigenesCapitales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrigenesCapitales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

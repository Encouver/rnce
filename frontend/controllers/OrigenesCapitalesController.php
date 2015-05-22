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
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $origen_capital = new OrigenesCapitales();

        if ($origen_capital->load(Yii::$app->request->post()) && $origen_capital->save()) {
            return $this->redirect(['view', 'id' => $origen_capital->id]);
        } else {
            return $this->render('create', [
                'origen_capital' => $origen_capital,
            ]);
        }
    }
     public function actionCrearefectivo()
    {
        $model = new OrigenesCapitales();
        $model->efectivo=true;
        $model->scenario='efectivo';
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }
     public function actionCrearefectivobanco()
    {
        $model = new OrigenesCapitales();
        $model->banco=true;
        $model->scenario='banco';
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }
     public function actionCrearbien()
    {
        $model = new OrigenesCapitales();
        $model->bien=true;
        $model->scenario='bien';
            return $this->render('create', [
                'model' => $model,
            ]);
        
    }
    
     public function actionCrearcapital()
    {
          $origen_capital = new OrigenesCapitales();
          
          
          if ($origen_capital->load(Yii::$app->request->post())) {
           
              
                     
              
                    $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
                    $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>$usuario->contratista_id, 'tipo_documento_id'=>1]);
                    $origen_capital->contratista_id=$usuario->contratista_id;
                    $origen_capital->documento_registrado_id=$registro->id;
                    
                    if($origen_capital->save()){
                        return $this->redirect(['origen']);
                    }else{
                       
             
                        return $this->render('create', [
                            'model' => $origen_capital,
                            ]);
                    }
                    
                     
            }else{
                
                        return $this->render('create', [
                            'model' => $origen_capital,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

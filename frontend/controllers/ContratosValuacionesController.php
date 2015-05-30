<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ContratosValuaciones;
use app\models\ContratosValuacionesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Html;
/**
 * ContratosValuacionesController implements the CRUD actions for ContratosValuaciones model.
 */
class ContratosValuacionesController extends BaseController
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
     * Lists all ContratosValuaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContratosValuacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContratosValuaciones model.
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
     * Creates a new ContratosValuaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContratosValuaciones();

         if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                   
                    Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Factura guarda con exito')));
                    $model = new ContratosFacturas();
                    return $this->renderAjax('create', [
                        'model' => $model,
                    ]);
                }else{
                    return $this->renderAjax('create', [
                        'model' => $model,
                         ]);
                }
            
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ContratosValuaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

         if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['relaciones-contratos/index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ContratosValuaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['relaciones-contratos/index']);
    }

    /**
     * Finds the ContratosValuaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ContratosValuaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContratosValuaciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

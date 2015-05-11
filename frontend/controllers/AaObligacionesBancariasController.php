<?php

namespace frontend\controllers;

use Yii;
use common\models\c\AaObligacionesBancarias;
use app\models\AaObligacionesBancariasSearch;
use common\components\BaseController;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AaObligacionesBancariasController implements the CRUD actions for AaObligacionesBancarias model.
 */
class AaObligacionesBancariasController extends BaseController
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

    public function actionObligacionesbancarias(){
        $query = AaObligacionesBancarias::find()->indexBy('id'); // where `id` is your primary key

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
        ]);

        $model = new AaObligacionesBancarias();

        return $this->render('obligacionesbancarias', ['dataProvider' => $dataProvider, 'model' => $model]);
    }
    public function actionTabsData()
    {
        $model = new AaObligacionesBancarias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $html = $this->renderAjax('_form',['model'=>$model]);
            return Json::encode($html);

/*            return $this->renderPartial('_form', [
                'model' => $model,
            ]);*/
        }


    }
    /**
     * Lists all AaObligacionesBancarias models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AaObligacionesBancariasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AaObligacionesBancarias model.
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
     * Creates a new AaObligacionesBancarias model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AaObligacionesBancarias();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            print_r($model->getErrors());
            die;
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AaObligacionesBancarias model.
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
     * Deletes an existing AaObligacionesBancarias model.
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
     * Finds the AaObligacionesBancarias model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AaObligacionesBancarias the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AaObligacionesBancarias::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

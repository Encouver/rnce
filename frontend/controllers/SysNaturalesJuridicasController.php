<?php

namespace frontend\controllers;

use Yii;
use common\models\p\SysNaturalesJuridicas;
use app\models\SysNaturalesJuridicasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SysNaturalesJuridicasController implements the CRUD actions for SysNaturalesJuridicas model.
 */
class SysNaturalesJuridicasController extends BaseController
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
     * Lists all SysNaturalesJuridicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SysNaturalesJuridicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SysNaturalesJuridicas model.
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
     * Creates a new SysNaturalesJuridicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SysNaturalesJuridicas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
    
    public function actionNaturaljuridicalist($q = null, $id = null,$juridica=null) {
    $buscar_juridica= "rif ILIKE "."'%" . $q ."%' or denominacion ILIKE "."'%" . $q ."%'";   
      
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
        if(!is_null($juridica)){
             $buscar_juridica= "rif ILIKE "."'%" . $q ."%' and juridica=".$juridica;
        }
        $query->select("id, (rif || ' - ' || denominacion)  AS text")
            ->from('sys_naturales_juridicas')
            ->where($buscar_juridica)
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => SysNaturalesJuridicas::find($id)->rif];
    }
  
    return $out;
}
    /**
     * Updates an existing SysNaturalesJuridicas model.
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
     * Deletes an existing SysNaturalesJuridicas model.
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
     * Finds the SysNaturalesJuridicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SysNaturalesJuridicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SysNaturalesJuridicas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

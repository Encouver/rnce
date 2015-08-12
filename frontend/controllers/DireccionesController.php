<?php

namespace frontend\controllers;

use common\components\BaseController;
use Yii;
use common\models\p\Direcciones;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;
use yii\helpers\ArrayHelper;
use app\modelsDireccionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * DireccionesController implements the CRUD actions for Direcciones model.
 */
class DireccionesController extends BaseController
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
     * Lists all Direcciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new modelsDireccionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Direcciones model.
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
     * Creates a new Direcciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Direcciones();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Direcciones model.
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
     * Deletes an existing Direcciones model.
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
     * Finds the Direcciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Direcciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Direcciones::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionMunicipioslista() {
           $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $estado = $parents[0];
           $out = SysMunicipios::find()->where(['sys_estado_id'=>$estado])->all();
           $resultado=[];
          if(isset($out)){
              foreach ($out as $municipio) {
                   $resultado = array_merge ( $resultado ,[['id' =>$municipio->id , 'name' =>$municipio->nombre]]);
              }
          }else{
              return Json::encode(['output'=>'', 'selected'=>'']);
          }
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
           
             return Json::encode(['output'=>$resultado, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>'', 'selected'=>'']);
    }
    public function actionParroquiaslista() {
           $out = [];
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $municipio = $parents[0];
           $out = SysParroquias::find()->where(['sys_municipio_id'=>$municipio])->all();
           $resultado=[];
          if(isset($out)){
              foreach ($out as $parroquia) {
                   $resultado = array_merge ( $resultado ,[['id' =>$parroquia->id , 'name' =>$parroquia->nombre]]);
              }
          }else{
              return Json::encode(['output'=>'', 'selected'=>'']);
          }
            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]
           
             return Json::encode(['output'=>$resultado, 'selected'=>'']);
        }
    }
    return Json::encode(['output'=>'', 'selected'=>'']);
    }

}

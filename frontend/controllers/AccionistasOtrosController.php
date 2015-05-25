<?php

namespace frontend\controllers;

use Yii;
use common\models\p\AccionistasOtros;
use app\models\AccionistasOtrosSearch;
use common\models\a\ActivosDocumentosRegistrados;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AccionistasOtrosController implements the CRUD actions for AccionistasOtros model.
 */
class AccionistasOtrosController extends BaseController
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
     * Lists all AccionistasOtros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccionistasOtrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccionistasOtros model.
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
     * Creates a new AccionistasOtros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccionistasOtros();

        if ($model->load(Yii::$app->request->post())) {
            $registro = ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id, 'tipo_documento_id'=>1]);
            $model->documento_registrado_id=$registro->id;
            $model->contratista_id = Yii::$app->user->identity->contratista_id;
            if($model->tipo_cargo==""){
                $model->tipo_cargo=null;
            }
            if($model->accionista==0 && $model->junta_directiva==0 && $model->rep_legal==0){
                  Yii::$app->session->setFlash('error','Debe ingresar si es contratista, representante legal o junta directiva');
                 return $this->render('create', [
                'model' => $model,
            ]);
            }
            if($model->save()){
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
     * Updates an existing AccionistasOtros model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             if($model->tipo_cargo==""){
                $model->tipo_cargo=null;
            }
            if($model->accionista==0 && $model->junta_directiva==0 && $model->rep_legal==0){
                  Yii::$app->session->setFlash('error','Debe ingresar si es contratista, representante legal o junta directiva');
                 return $this->render('create', [
                'model' => $model,
            ]);
            }
            if($model->save()){
                 return $this->redirect(['index']);
            }else{
                Yii::$app->session->setFlash('error','Error en la carga');
                 return $this->render('update', [
                'model' => $model,
            ]);
            }
           
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    
     public function actionAccionistasOtrosLista($q = null, $id = null) {
    $buscar_accionista= "natura.denominacion ILIKE "."'%" . $q ."%' and natura.id=accionista.natural_juridica_id and accionista.junta_directiva=false";   
       
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
        
        $query->select("accionista.natural_juridica_id, natura.denominacion AS text")
            ->from('accionistas_otros as accionista, sys_naturales_juridicas as natura')
            ->where($buscar_accionista)
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => ActivosBienes::find($id)->detalle];
    }
  
    return $out;
}

    /**
     * Deletes an existing AccionistasOtros model.
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
     * Finds the AccionistasOtros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccionistasOtros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccionistasOtros::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\controllers;

use Yii;
use common\models\p\CertificacionesAportes;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\CertificacionesAportesSearch;
use common\models\p\PersonasNaturales;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CertificacionesAportesController implements the CRUD actions for CertificacionesAportes model.
 */
class CertificacionesAportesController extends BaseController
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
     * Lists all CertificacionesAportes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CertificacionesAportesSearch();
        $searchModel->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CertificacionesAportes model.
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
     * Creates a new CertificacionesAportes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CertificacionesAportes();
        $modelPersona = new PersonasNaturales(['scenario'=>'basico']);
        if ($model->load(Yii::$app->request->post()) && !$model->accionista()) {
            if($model->tipo_profesion!='CONTADOR PUBLICO'){
                $model->colegiatura=null;
            }
             $model->save();   
              Yii::$app->session->setFlash('success','Certificacion de aportes guardado con exito');
              return $this->redirect(['index']);
        } else {
             if($model->accionista()){
                Yii::$app->session->setFlash('error','El certificador de aportes no puede formar parte de los accionista o junta directiva');
           
            }
            return $this->render('create', [
                'model' => $model,
                'modelPersona'=>$modelPersona
            ]);
        }
    }

    /**
     * Updates an existing CertificacionesAportes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelPersona = new PersonasNaturales(['scenario'=>'basico']);
        if ($model->load(Yii::$app->request->post()) && !$model->accionista()) {
             if($model->tipo_profesion!='CONTADOR PUBLICO'){
                $model->colegiatura=null;
            }
            $model->save();
             Yii::$app->session->setFlash('success','Certificacion de aportes guardado con exito');
                    return $this->redirect(['index']);
        } else {
              if($model->accionista()){
                Yii::$app->session->setFlash('error','El certificador de aportes no puede formar parte de los accionista o junta directiva');
           
            }
            return $this->render('update', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
            ]);
        }
    }

    /**
     * Deletes an existing CertificacionesAportes model.
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
     * Finds the CertificacionesAportes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CertificacionesAportes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CertificacionesAportes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
     public function actionCertificacionesAportesLista($q = null, $id = null) {
    $buscar_certificacion= "natura.denominacion ILIKE "."'%" . $q ."%' and natura.id=certificacion.natural_juridica_id";   
       
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
        
        $query->select("certificacion.id, natura.denominacion AS text")
            ->from('certificaciones_aportes as certificacion, sys_naturales_juridicas as natura')
            ->where($buscar_certificacion)
            ->limit(20);
        $command = $query->createCommand();
        $data = $command->queryAll();
        
        $out['results'] = array_values($data);
    }
    elseif ($id > 0) {
        $out['results'] = ['id' => $id, 'text' => 'hola mundo'];
    }
  
    return $out;
    }

}

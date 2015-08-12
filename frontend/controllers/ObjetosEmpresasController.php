<?php

namespace frontend\controllers;

use Yii;
use common\models\p\ObjetosEmpresas;
use common\models\p\ObjetosAutorizaciones;
use app\models\ObjetosAutorizacionesSearch;
use common\models\p\User;
use common\models\p\Model;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasJuridicas;
use common\models\p\RelacionesObjetos;
use app\models\ObjetosEmpresasSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ObjetosEmpresasController implements the CRUD actions for ObjetosEmpresas model.
 */
class ObjetosEmpresasController extends BaseController
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
     * Lists all ObjetosEmpresas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ObjetosEmpresasSearch();
        $searchModel->contratista=true;
        $searchModel->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = false;

        $searchModelAutorizado = new ObjetosAutorizacionesSearch();
        $searchModelAutorizado->contratista_id = Yii::$app->user->identity->contratista_id;
        $dataProviderAutorizado = $searchModelAutorizado->search(Yii::$app->request->queryParams);
        $dataProviderAutorizado->sort = false;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModelAutorizado' => $searchModelAutorizado,
            'dataProviderAutorizado' => $dataProviderAutorizado,
        ]);
    }

    /**
     * Displays a single ObjetosEmpresas model.
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
     * Creates a new ObjetosEmpresas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       
        $model = new ObjetosEmpresas();
        if(isset($_POST['objeto'])){
             $valores=$_POST['objeto'];
            $cantidad= count($valores);
            
             for ($i = 0; $i < $cantidad; $i++) {
                  $objeto= ObjetosEmpresas::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'contratista'=>true,'objeto_empresa'=>$valores[$i]]);

                    if(isset($objeto)){
                    Yii::$app->session->setFlash('error','Usuario ya posee '.$valores[$i].' asociada');
                         return $this->render('create', [
                            'model' => $model,
                            ]);
                            
                     }else{
                         $objeto_empresa= new ObjetosEmpresas();
                         $objeto_empresa->contratista=true;
                         $objeto_empresa->contratista_id = Yii::$app->user->identity->contratista_id;
                         $objeto_empresa->objeto_empresa=$valores[$i];
                         if(!$objeto_empresa->save()){
                               Yii::$app->session->setFlash('error','Eror al cargar '.$valores[$i]);
                         return $this->render('create', [
                            'model' => $model,
                            ]);
                         break;
                         }
                     }
             }
             return $this->redirect(['index']);
            }else{
                 return $this->render('create', [
                'model' => $model,
            ]);
            }
     
        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
    }
    
    /**
     * Updates an existing ObjetosEmpresas model.
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
     * Deletes an existing ObjetosEmpresas model.
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
     * Finds the ObjetosEmpresas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ObjetosEmpresas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ObjetosEmpresas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

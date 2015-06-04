<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PersonasJuridicas;
use common\models\p\SysNaturalesJuridicas;
use app\models\PersonasJuridicasSearch;
use common\components\BaseController;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonasJuridicasController implements the CRUD actions for PersonasJuridicas model.
 */
class PersonasJuridicasController extends BaseController
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

    public function actionJuridicasLista($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, (rif || \' - \' || razon_social) AS text')
                ->from('personas_juridicas')
                ->where('rif LIKE \'%' . $q .'%\' or razon_social ILIKE \'%'.$q .'%\'')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => PersonasJuridicas::find($id)->etiqueta()];
        }
        return $out;
    }

    /**
     * Lists all PersonasJuridicas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonasJuridicasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonasJuridicas model.
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
     * Creates a new PersonasJuridicas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonasJuridicas();

       if ($model->load(Yii::$app->request->post())) {
             $transaction = \Yii::$app->db->beginTransaction();
           try {
                $natural_juridica= new SysNaturalesJuridicas();
               if($model->tipo_nacionalidad=='NACIONAL'){
                $model->sys_pais_id=1;
                $model->numero_identificacion=null;
                }else{
                $natural_juridica->nacional=false;
                $model->rif=$model->numero_identificacion;
                }
                 $natural_juridica->rif= $model->rif;
                $natural_juridica->juridica= true;
                $natural_juridica->denominacion=$model->razon_social;
                  if($model->tipo_nacionalidad=='EXTRANJERA'){
                       $natural_juridica->anho = date('m-Y');
                      $natural_juridica->contratista_id=Yii::$app->user->identity->contratista_id;
                      $natural_juridica->save(false);
                      $model->anho = date('m-Y');
                      $model->contratista_id=Yii::$app->user->identity->contratista_id;
                      $model->save(false);
                      $transaction->commit();
                             Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Persona juridica guarda con exito.')));
                            $model = new PersonasJuridicas();
                            return $this->renderAjax('create', [
                                'model' => $model,
                            ]);
                  }else {

                if ($natural_juridica->save()) {
               
                          if($model->save()){
                            $transaction->commit();
                             Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Persona juridica guarda con exito.')));
                            $model = new PersonasJuridicas();
                            return $this->renderAjax('create', [
                                'model' => $model,
                            ]);
                            }
                    
                           
                    }else{
                          $transaction->rollBack();
                    return $this->renderAjax('create', [
                    'model' => $model,]);
                    }
                
           }
           }catch (Exception $e) {
               $transaction->rollBack();
           }
        } else {
             return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing PersonasJuridicas model.
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
     * Deletes an existing PersonasJuridicas model.
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
     * Finds the PersonasJuridicas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonasJuridicas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonasJuridicas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

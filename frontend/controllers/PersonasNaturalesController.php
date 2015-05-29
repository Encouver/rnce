<?php

namespace frontend\controllers;

use Yii;
use common\models\p\PersonasNaturales;
use app\models\PersonasNaturalesSearch;
use common\models\p\SysNaturalesJuridicas;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonasNaturalesController implements the CRUD actions for PersonasNaturales model.
 */
class PersonasNaturalesController extends Controller
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

    public function actionNaturalesLista($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, (rif || \' - \' || primer_nombre ||  segundo_nombre ||  primer_apellido ||  segundo_apellido ) AS text')
                ->from('personas_juridicas')
                ->where('rif LIKE \'%' . $q .'%\' or ci LIKE \'%' . $q .'%\' or (primer_nombre ||  segundo_nombre ||  primer_apellido ||  segundo_apellido) ILIKE \'%'.$q .'%\'')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => PersonasNaturales::find($id)->etiqueta()];
        }
        return $out;
    }

    /**
     * Lists all PersonasNaturales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonasNaturalesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PersonasNaturales model.
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
     * Creates a new PersonasNaturales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PersonasNaturales();

        if ($model->load(Yii::$app->request->post())) {
             $transaction = \Yii::$app->db->beginTransaction();
           try {
                $natural_juridica= new SysNaturalesJuridicas();
               if($model->nacionalidad=='NACIONAL'){
                $model->sys_pais_id=1;
                $model->numero_identificacion=null;
               
                $natural_juridica->rif= $model->rif;
                }else{
                $natural_juridica->rif= $model->numero_identificacion;
                $natural_juridica->nacional=false;
                $model->rif=$model->numero_identificacion;
                }
                if($model->estado_civil==''){
                    $model->estado_civil=null;
                }
                $natural_juridica->juridica= false;
                $natural_juridica->denominacion=$model->primer_nombre.' '.$model->primer_apellido;
                if (!$natural_juridica->save()) {
                    $transaction->rollBack();
                    return $this->renderAjax('create', [
                    'model' => $model,]);
                    }
                if($model->save()){
                    $transaction->commit();
                    Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Documento registrado guardado.')));
                    $model = new PersonasNaturales(['scenario'=>'basico']);
                    return $this->renderAjax('create', [
                        'model' => $model,
                    ]);
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
     * Updates an existing PersonasNaturales model.
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
     * Deletes an existing PersonasNaturales model.
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
     * Finds the PersonasNaturales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PersonasNaturales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PersonasNaturales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

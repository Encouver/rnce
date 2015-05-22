<?php

namespace frontend\controllers;

use Yii;
use common\models\p\AccionistasOtros;
use app\models\AccionistasOtrosSearch;
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    
     public function actionCrearaccionistaotro()
    {
       return $this->render('_accionistas');
    }
     public function actionCrearaccionista()
    {
        $accionista_otro = new AccionistasOtros();
        $usuario= \common\models\p\User::findOne(Yii::$app->user->identity->id);
        if ($accionista_otro->load(Yii::$app->request->post())) {
            
             $transaction = \Yii::$app->db->beginTransaction();
           try {
                
            if($accionista_otro->accionista=="1" && $accionista_otro->porcentaje_accionario==null){
               return "Datos incompletos debe ingresar el porcentaje accionario";
            }
             if($accionista_otro->accionista=="0" && $accionista_otro->porcentaje_accionario!=null){
               return "Debe seleccionar el campo accionista";
            }
             if($accionista_otro->junta_directiva=="1" && $accionista_otro->cargo==null){
               return "Datos incompletos debe ingresar el cargo";
            }
            if($accionista_otro->junta_directiva=="0" && $accionista_otro->cargo!=null){
               return "Datos seleccionar el campo junta directiva";
            }
            if($accionista_otro->rep_legal=="1" && $accionista_otro->repr_legal_vigencia==null){
               return "Datos incompletos debe ingresar la fecha de vigencia";
            }

            if($accionista_otro->rep_legal=="0" && $accionista_otro->repr_legal_vigencia!=null){
                return "Datos seleccionar el campo representante legal";
            }
            $accionista_otro->contratista_id = $usuario->contratista_id;
           
               if ($accionista_otro->save()) {
           

                               $transaction->commit();
                               return "Datos guardados con exito";
                               


                   }else{
                        $transaction->rollBack();
                       return "Datos no guardados";
                   }
             
             
           } catch (Exception $e) {
               $transaction->rollBack();
           }
        }
    }
    
    
     
    public function actionNaturaljuridicalist($q = null, $id = null) {
        
       
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
        $query->select("id, (rif || ' ' || denominacion)  AS text")
            ->from('sys_naturales_juridicas')
            ->where("rif ILIKE "."'%" . $q ."%'")
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
     * Updates an existing AccionistasOtros model.
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

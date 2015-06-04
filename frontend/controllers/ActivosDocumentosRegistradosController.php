<?php

namespace frontend\controllers;

use Yii;
use common\models\a\ActivosDocumentosRegistrados;
use app\models\ActivosDocumentosRegistrados as ActivosDocumentosRegistradosSearch;
use common\components\BaseController;
use yii\db\Query;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\p\RazonesSociales;
use yii\helpers\Url;

/**
 * ActivosDocumentosRegistradosController implements the CRUD actions for ActivosDocumentosRegistrados model.
 */
class ActivosDocumentosRegistradosController extends BaseController
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
    public function actionDocumentosRegistradosLista($q = null, $id = null) {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query;
            $query->select('doc.id, (tipo.nombre || \' - \' || num_registro_notaria) AS text')
                ->from('activos.documentos_registrados as doc, activos.sys_tipos_registros as tipo')
                ->where('num_registro_notaria LIKE \'%' . $q .'%\' and contratista_id='.Yii::$app->user->identity->contratista_id.' and tipo.id=doc.sys_tipo_registro_id')
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $out['results'] = ['id' => $id, 'text' => ActivosDocumentosRegistrados::find($id)->etiqueta()];
        }
        return $out;
    }
    /**
     * Lists all ActivosDocumentosRegistrados models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ActivosDocumentosRegistradosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new ActivosDocumentosRegistrados();
        $model->scenario='actas';
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    /**
     * Displays a single ActivosDocumentosRegistrados model.
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
     * Creates a new ActivosDocumentosRegistrados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateGeneral($id=2)
    {
        $model = new ActivosDocumentosRegistrados();

        if ($model->load(Yii::$app->request->post()) ) {
            //
                $model->sys_tipo_registro_id = $id;

            if($model->save()) {


                Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Documento registrado guardado.')) /*[
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'fa fa-users',
                    'message' => Yii::t('app',Html::encode('Documento registrado guaradado.')),
                    'title' => Yii::t('app',Html::encode('Documento registrado')),
                    'positonY' => 'top',
                    'positonX' => 'center'
                ]*/);
                $model = new ActivosDocumentosRegistrados();
                $url= Url::to(['create-general']);
                return $this->renderAjax('create', [
                    'model' => $model,
                    'url'=>$url
                ]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $url= Url::to(['create-general']);
            return $this->renderAjax('create', [
                'model' => $model,
                'url'=>$url,
            ]);
        }
    }

    /**
     * Creates a new ActivosDocumentosRegistrados model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ActivosDocumentosRegistrados();
        $model = new ActivosDocumentosRegistrados(['scenario'=>'actas']);
         if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee una documento registrado en proceso');
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post()) ) {
                 if($model->existeregistro()){
                    Yii::$app->session->setFlash('error','Usuario posee una documento registrado en proceso');
                    return $this->redirect(['index']);
                }
                    $model->proceso_finalizado=false;
                    if($model->save()){
                        if($model->tipo_documento_id==1){
                             $razon= new RazonesSociales();
                            if(!$razon->Existeregistro()){
                            $razon->nombre=$razon->asignarnombre();
                            }
                        }
                       
                        
                    Yii::$app->session->setFlash('success','Documento registrado con exito');
                     return $this->redirect(['index']);
                    }else{
                    Yii::$app->session->setFlash('error','Error en la carga del documento');
                     return $this->redirect(['index']);
                        }
        } else {
             $url= Url::to(['create']);
            return $this->renderAjax('create', [
                'model' => $model,
                'url'=>$url,
            ]);
        }
    }
    public function actionCreateempresarelacionada()
    {
        $model = new ActivosDocumentosRegistrados();

        if ($model->load(Yii::$app->request->post()) ) {
            //
                $model->sys_tipo_registro_id = 3;
                $model->tipo_documento_id = 3;

            if($model->save()) {


                Yii::$app->getSession()->setFlash('success',Yii::t('app',Html::encode('Documento registrado guardado.')) /*[
                    'type' => 'success',
                    'duration' => 5000,
                    'icon' => 'fa fa-users',
                    'message' => Yii::t('app',Html::encode('Documento registrado guaradado.')),
                    'title' => Yii::t('app',Html::encode('Documento registrado')),
                    'positonY' => 'top',
                    'positonX' => 'center'
                ]*/);
                $model = new ActivosDocumentosRegistrados();
                $url= Url::to(['createempresarelacionada']);
                return $this->renderAjax('create', [
                    'model' => $model,
                    'url'=>$url
                ]);
            }
            //return $this->redirect(['view', 'id' => $model->id]);
        } else {
            $url= Url::to(['createempresarelacionada']);
                return $this->renderAjax('create', [
                    'model' => $model,
                    'url'=>$url
                ]);
        }
    }

   

    /**
     * Updates an existing ActivosDocumentosRegistrados model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->tipo_documento_id==1 ||$model->tipo_documento_id==2){
            $model->scenario='actas';
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
              Yii::$app->session->setFlash('success','Documento Actualizado con exito');
                     return $this->redirect(['index']);
        } else {
            $url= Url::to(['update']);
            return $this->render('update', [
                'model' => $model,
                 'url'=>$url
            ]);
        }
    }

    /**
     * Deletes an existing ActivosDocumentosRegistrados model.
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
     * Finds the ActivosDocumentosRegistrados model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ActivosDocumentosRegistrados the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ActivosDocumentosRegistrados::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

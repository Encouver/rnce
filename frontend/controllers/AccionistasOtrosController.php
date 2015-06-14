<?php

namespace frontend\controllers;

use Yii;
use common\models\p\AccionistasOtros;
use app\models\AccionistasOtrosSearch;
use common\models\a\ActivosDocumentosRegistrados;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
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
        $searchModel= new AccionistasOtrosSearch();
        $documento= ActivosDocumentosRegistrados::findOne(['contratista_id'=>Yii::$app->user->identity->contratista_id,'tipo_documento_id'=>1]);
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->id;
        }
        $searchModel->accionista= true;
        $searchModel->rep_legal= false;
        $searchModel->junta_directiva=false;
        $dataProviderAccionista = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->accionista= false;
        $searchModel->rep_legal= false;
        $searchModel->rep_legal= true;
        $dataProviderRepresentante = $searchModel->search(Yii::$app->request->queryParams);
        $searchModel->accionista= false;
        $searchModel->rep_legal= false;
        $searchModel->junta_directiva=true;
        $dataProviderJunta = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProviderAccionista' => $dataProviderAccionista,
            'dataProviderRepresentante' => $dataProviderRepresentante,
            'dataProviderJunta' => $dataProviderJunta,
        ]);
    }
    public function actionRepresentante()
    {
        $searchModel = new AccionistasOtrosSearch();
        $documento=  $searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
        }
        $searchModel->rep_legal=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('representante', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
        ]);
    }
     public function actionJunta()
    {
        $searchModel = new AccionistasOtrosSearch();
        $documento=  $searchModel->Modificacionactual();
        if(isset($documento)){
            $searchModel->documento_registrado_id= $documento->documento_registrado_id;
        }
        $searchModel->junta_directiva=true;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('junta', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'documento'=>$documento,
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
    public function actionCreate($id)
    {
        $model = new AccionistasOtros();
        $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
        $modelJuridica= new PersonasJuridicas();
        
        
       if($model->existeregistro($id)){
            Yii::$app->session->setFlash('error','Debe existir un acta constitutiva o una modificacion');
            switch ($id){
            
                case 'accionista':
                     Yii::$app->session->setFlash('error','Debe existir un acta constitutiva');
                     return $this->redirect(['index']);
                break;
                case 'representante':
                    Yii::$app->session->setFlash('error','Representante Legal existente');
                     return $this->redirect(['index']);
                break;
                case 'junta':
                    Yii::$app->session->setFlash('error','No existe un proceso de Actualizacion de Junta DIrectiva valido');
                    return $this->redirect(['index']);
                break;
                default:
                    Yii::$app->session->setFlash('error','Parametro incorrecto');
                    return $this->redirect(['index']);
                break;
             }
           
        }
       
        switch ($id){
            
             case 'accionista':
                $model->scenario=$id;
                 if($model->documentoRegistrado->tipo_documento_id!=1){
                     Yii::$app->session->setFlash('error','Scenario incorrecto');
                     return $this->redirect(['index']);
                 }
            break;
            case 'representante':
                $model->scenario=$id;
            break;
            case 'junta':
                $model->scenario=$id;
            break;
            default:
                Yii::$app->session->setFlash('error','Parametro incorrecto');
                return $this->redirect(['index']);
            break;
        }
            
        
        if ($model->load(Yii::$app->request->post())) {
             $transaction = \Yii::$app->db->beginTransaction();
             $exitoso= true;
                try {
                         if($model->tipo_cargo==""){
                             $model->tipo_cargo=null;
                         }
                         switch ($id){
                            case 'accionista':
                                if($model->tipo_cargo!=null){
                                    $junta= AccionistasOtros::findOne(['documento_registrado_id' => $model->documento_registrado_id, 'junta_directiva'=>true,'natural_juridica_id'=>$model->natural_juridica_id]);
                                    if(isset($junta)){
                                        if(!$junta->delete()){
                                            $transaction->rollBack();
                                        }
                                    }
                                    $junta= new AccionistasOtros();
                                    $junta->natural_juridica_id=$model->natural_juridica_id;
                                    $junta->documento_registrado_id=$model->documento_registrado_id;
                                    $junta->junta_directiva=true;
                                    $junta->tipo_cargo=$model->tipo_cargo;
                                    $junta->tipo_obligacion=$model->tipo_obligacion;
                                    $junta->actual=true;
                                    if(!$junta->save()){
                                        
                                        $transaction->rollBack();
                                        
                                        $model->addError('tipo_cargo','Ya existe este cargo asignado');
                                        return $this->render('create', [
                                            'model' => $model,
                                            'modelPersona'=>$modelPersona,
                                            'modelJuridica'=>$modelJuridica,
                                            ]);
                                    }   
                                }
                                $representante= AccionistasOtros::findOne(['documento_registrado_id' => $model->documento_registrado_id, 'rep_legal'=>true,'natural_juridica_id'=>$model->natural_juridica_id]);
                                if(isset($representante)){
                                  $model->repr_legal_vigencia=$representante->repr_legal_vigencia;
                                } 
                            break;
                            case 'representante':
                                $accionista= AccionistasOtros::findOne(['documento_registrado_id' => $model->documento_registrado_id, 'accionista'=>true,'natural_juridica_id'=>$model->natural_juridica_id]);
                                if(isset($accionista)){
                                   $accionista->repr_legal_vigencia=$model->repr_legal_vigencia;
                                   if(!$accionista->save()){
                                        $transaction->rollBack();
                                    } 
                                } 
                                
                            break;
                            case 'junta':
                                $accionista= AccionistasOtros::findOne(['documento_registrado_id' => $model->documento_registrado_id, 'accionista'=>true,'natural_juridica_id'=>$model->natural_juridica_id]);
                                if(isset($accionista)){
                                   $accionista->tipo_cargo=$model->tipo_cargo;
                                   if(!$accionista->save()){
                                        $transaction->rollBack();
                                    } 
                                }
                            break;
                            default:
                            break;
                        }
                      if($model->save()){
                          $transaction->commit();
                          if($model->rep_legal && $model->documentoRegistrado->tipo_documento_id==2){
                              return $this->redirect(['representante']); 
                          }else{
                              if($model->junta_directiva && $model->documentoRegistrado->tipo_documento_id==2){
                              return $this->redirect(['junta']); 
                                }else{
                                     return $this->redirect(['index']); 
                                }
                          }
                          
                      }else{
                          $transaction->rollBack();
                           return $this->render('create', [
                            'model' => $model,
                             'modelPersona'=>$modelPersona,
                            'modelJuridica'=>$modelJuridica,
                            ]);
                      }
                        
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
          
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
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
        $modelPersona= new PersonasNaturales(['scenario'=>'basico']);
        $modelJuridica= new PersonasJuridicas();
        $documento= $model->Modificacionactual();
        if($model->documentoRegistrado->tipo_documento_id==1){
            if($model->Existeacta()){
                 Yii::$app->session->setFlash('error','El acta constitutiva ya fue creada');
                  return $this->redirect(['index']);
            }else{
                if($model->accionista){
                     $model->scenario='accionista';
                }else{
                    if($model->rep_legal){
                        $model->scenario='representante';
                    }else{
                        if($model->junta_directiva){
                        $model->scenario='junta';
                        }
                    }
                }
               
            }
            
        }else{
           
            if(isset($documento) && $model->documento_registrado_id==$documento->documento_registrado_id){
                if($documento->representante_legal && $model->rep_legal){
                    $model->scenario='representante';
                }else{
             
                        $model->scenario='junta';
                    
                }
                 
            }else{
                  Yii::$app->session->setFlash('error','No exista una modificacion activa que le permita la modificacion de este registro');
                  return $this->redirect(['index']);
            }
        }
        
        
        if ($model->load(Yii::$app->request->post())) {
             if($model->tipo_cargo==""){
                $model->tipo_cargo=null;
            }
            if($model->accionista==0 && $model->junta_directiva==0 && $model->rep_legal==0){
                  Yii::$app->session->setFlash('error','Debe ingresar si es contratista, representante legal o junta directiva');
                 return $this->render('update', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
            ]);
            }
         
            if($model->save()){
                if($model->rep_legal && $model->documentoRegistrado->tipo_documento_id==2){
                              return $this->redirect(['representante']); 
                          }else{
                              if($model->junta_directiva && $model->documentoRegistrado->tipo_documento_id==2){
                              return $this->redirect(['junta']); 
                                }else{
                                     return $this->redirect(['index']); 
                                }
                          }
            }else{
                Yii::$app->session->setFlash('error','Error en la carga');
                 return $this->render('update', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
            ]);
            }
           
        } else {
            return $this->render('update', [
                'model' => $model,
                'modelPersona'=>$modelPersona,
                'modelJuridica'=>$modelJuridica,
            ]);
        }
    }
    
     public function actionAccionistasOtrosLista($q = null, $id = null,$sucursal=null) {
    $buscar_accionista= "natura.denominacion ILIKE "."'%" . $q ."%' and natura.id=accionista.natural_juridica_id and accionista.junta_directiva=false";   
      //$buscar_accionista= "natura.denominacion ILIKE "."'%" . $q ."%' and natura.id=accionista.natural_juridica_id and accionista.accionista=true";     
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $out = ['results' => ['id' => '', 'text' => '']];
    if (!is_null($q)) {
        $query = new \yii\db\Query;
       if(!is_null($sucursal)){
                 $buscar_accionista= "natura.denominacion ILIKE "."'%" . $q ."%' and natura.id=accionista.natural_juridica_id and accionista.accionista=true";   
            }
        
        $query->select("natura.id, natura.denominacion AS text")
            ->from('accionistas_otros as accionista, sys_naturales_juridicas as natura')
            ->where($buscar_accionista)
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

    /**
     * Deletes an existing AccionistasOtros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->rep_legal){
            $accionista= AccionistasOtros::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'natural_juridica_id'=>$model->natural_juridica_id,'accionista'=>true]);
            if(isset($accionista)){
                $accionista->repr_legal_vigencia=null;
                if($accionista->save()){
                    $model->delete();
                }
            }
            
        }else{
            if($model->junta_directiva){
            $accionista= AccionistasOtros::findOne(['documento_registrado_id'=>$model->documento_registrado_id,'natural_juridica_id'=>$model->natural_juridica_id,'accionista'=>true]);
            if(isset($accionista)){
                $accionista->tipo_cargo=null;
                if($accionista->save()){
                    $model->delete();
                }
            }
            
            }else{
                $model->delete();
            }
        }

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

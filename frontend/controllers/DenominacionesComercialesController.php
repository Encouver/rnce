<?php

namespace frontend\controllers;

use Yii;
use common\models\p\DenominacionesComerciales;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
use app\models\DenominacionesComercialesSearch;
use common\components\BaseController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
/**
 * DenominacionesComercialesController implements the CRUD actions for DenominacionesComerciales model.
 */
class DenominacionesComercialesController extends BaseController
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
     * Lists all DenominacionesComerciales models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DenominacionesComercialesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model= new DenominacionesComerciales();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single DenominacionesComerciales model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionSubcat() {
            $out = [];
            if (isset($_POST['depdrop_parents'])) {
                    
                $parents = $_POST['depdrop_parents'];
                if ($parents != null) {
                    $categoria = $parents[0];
                    switch ($categoria){
                        case "COMANDITA":
                            $out= [
                                    ['id' => 'COMANDITA SIMPLE', 'name' => 'COMANDITA SIMPLE'],
                                    ['id' => 'COMANDITA POR ACCIONES', 'name' => 'COMANDITA POR ACCIONES'],
                                ];
                            break;
                        case "SOCIEDAD CIVIL":
                            $out= [
                                    ['id' => 'CON FINES DE LUCRO', 'name' => 'CON FINES DE LUCRO'],
                                    ['id' => 'SIN FINES DE LUCRO', 'name' => 'SIN FINES DE LUCRO'],
                                ];
                            break;
                        case "ASOCIACION CIVIL":
                            $out= [
                                    ['id' => 'CON FINES DE LUCRO', 'name' => 'CON FINES DE LUCRO'],
                                    ['id' => 'SIN FINES DE LUCRO', 'name' => 'SIN FINES DE LUCRO'],
                                ];
                            break;
                        case "ASOCIACION CIVIL":
                            $out= [
                                    ['id' => 'CON FINES DE LUCRO', 'name' => 'CON FINES DE LUCRO'],
                                    ['id' => 'SIN FINES DE LUCRO', 'name' => 'SIN FINES DE LUCRO'],
                                ];
                            break;
                        case "EMPRESA EXTRANJERA":
                            $out=[
                            ['id' => 'CON DOMICILIO EN VENEZUELA', 'name' => 'CON DOMICILIO EN VENEZUELA'],
                            ['id' => 'SIN DOMICILIO EN VENEZUELA', 'name' => 'SIN DOMICILIO EN VENEZUELA']];
                            break;
                        case "FUNDACION":
                            $out=[
                                ['id' => 'FUNDACION DEL ESTADO (NACIONAL)', 'name' => 'FUNDACION DEL ESTADO (NACIONAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (ESTADAL)', 'name' => 'FUNDACION DEL ESTADO (ESTADAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'name' => 'FUNDACION DEL ESTADO (MUNICIPAL)']];

                            break;
                        case "ORGANIZACION SOCIOPRODUCTIVA":
                            $out=[
                                ['id' => 'FUNDACION DEL ESTADO (NACIONAL)', 'name' => 'FUNDACION DEL ESTADO (NACIONAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (ESTADAL)', 'name' => 'FUNDACION DEL ESTADO (ESTADAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'name' => 'FUNDACION DEL ESTADO (MUNICIPAL)']];

                            break;
                            case "ORGANIZACION SOCIOPRODUCTIVA":
                            $out=[
                                ['id' => 'FUNDACION DEL ESTADO (NACIONAL)', 'name' => 'FUNDACION DEL ESTADO (NACIONAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (ESTADAL)', 'name' => 'FUNDACION DEL ESTADO (ESTADAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'name' => 'FUNDACION DEL ESTADO (MUNICIPAL)']];

                            break;
                             case "SOCIEDAD ANONIMA":
                            $out=[
                                ['id' => 'FUNDACION DEL ESTADO (NACIONAL)', 'name' => 'FUNDACION DEL ESTADO (NACIONAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (ESTADAL)', 'name' => 'FUNDACION DEL ESTADO (ESTADAL)'],
                                ['id' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'name' => 'FUNDACION DEL ESTADO (MUNICIPAL)'],];

                            break;
                        default:
                        break;
                      

                    }
                    
                  

            // the getSubCatList function will query the database based on the
            // cat_id and return an array like below:
            // [
            // ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
            // ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
            // ]

                    return Json::encode(['output'=>$out, 'selected'=>'']);
                   
                }
            }
        return Json::encode(['output'=>'', 'selected'=>'']);
    }

    /**
     * Creates a new DenominacionesComerciales model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DenominacionesComerciales();
        $contratista= Contratistas::findOne( ['id' => Yii::$app->user->identity->contratista_id]);
        $natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);
        if($natural_juridica->juridica && $contratista->tipo_sector == "PRIVADO"){
            $model->sector="PRIVADO";
        }else{
            if(!$natural_juridica->juridica){
            $model->sector="NATURAL";
              }
        }
            if($model->existeregistro()){
            Yii::$app->session->setFlash('error','Usuario posee una denominacion comercial ó debe crear un documento registrado');
            return $this->redirect(['index']);
                }
        
        if ($model->load(Yii::$app->request->post())) {
      
           

                if($model->tipo_subdenominacion==''){
                    $model->tipo_subdenominacion=null;
                    }
                if($model->codigo_situr==''){
                    $model->codigo_situr=null;
                    }   
                if($model->cooperativa_capital==''){
                    $model->cooperativa_capital=null;
                    }
                if($model->cooperativa_distribuicion==''){
                    $model->cooperativa_distribuicion=null;
                }
             
                $model->asignarprincipio();
                $model->tieneotrosdatos();
                if($model->save()){
                    
                    Yii::$app->session->setFlash('success','Denominacion Comercial guardada con exito');
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
     * Updates an existing DenominacionesComerciales model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if($model->tipo_denominacion=="FIRMA PERSONAL" || $model->tipo_denominacion=="PERSONA NATURAL"){
            $model->sector="NATURAL";
        }else{
            if($model->tipo_denominacion=="FUNDACION"){
            $model->sector="PRIVADO";
               }
        }
        $model->tipo_denominacion='';
        $model->tipo_subdenominacion='';
        $model->codigo_situr='';
        $model->cooperativa_distribuicion='';
        $model->cooperativa_capital='';
        
        if ($model->load(Yii::$app->request->post())) {
            if($model->tipo_subdenominacion==''){
                    $model->tipo_subdenominacion=null;
                    }
                if($model->codigo_situr==''){
                    $model->codigo_situr=null;
                    }   
                if($model->cooperativa_capital==''){
                    $model->cooperativa_capital=null;
                    }
                if($model->cooperativa_distribuicion==''){
                    $model->cooperativa_distribuicion=null;
                }
                 $model->asignarprincipio();
                 $model->tieneotrosdatos();

                if($model->save()){
                    Yii::$app->session->setFlash('success','Denominacion Comercial Actualizada con exito');
                    return $this->redirect(['index']);
                }else{
                    Yii::$app->session->setFlash('error','Error en la carga');
                    return $this->render('create', [
                    'model' => $model,
                ]);
                }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DenominacionesComerciales model.
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
     * Finds the DenominacionesComerciales model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DenominacionesComerciales the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DenominacionesComerciales::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

/**************** PARA GENERAR LOS CRUDS ***************/
MODELOS

Name space: common\components;

Base class: common\components\BaseActiveRecord;


CONTROLADORES


Base Controller Class: common\components\BaseController

<?php







/**************************   FORMATEO DE  DATOS   **************************/


echo Yii::$app->formatter->asPercent(0.125, 2); // output: 12.50%
echo "<br>";
echo Yii::$app->formatter->asEmail('cebe@example.com'); // output: <a href="mailto:cebe@example.com">cebe@example.com</a>
echo "<br>";
echo Yii::$app->formatter->asBoolean(true); // output: Yes
echo "<br>";
// it also handles display of null values:
echo Yii::$app->formatter->asDate(null); // output: (Not set)
echo "<br>";
        //Yii::$app->formatter->locale = 'es-MX';
echo Yii::$app->formatter->asDate('2014-12-20'); // output: January 1, 2014
echo "<br>";
echo Yii::$app->formatter->asTime(1412599260); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asDateTime('2014-10-06 12:41:00'); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asTime('2014-10-06 14:41:00 CEST'); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asDecimal(20000000000.66464565); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asCurrency(1412599260); // 14:41:00
echo "<br>";
echo Yii::$app->formatter->asTime(1412599260); // 14:41:00
echo "<br>";
/*echo "<br>";
Yii::$app->formatter->locale = 'de-DE';
echo Yii::$app->formatter->asDate('2014-01-01'); // output: 1. Januar 2014
echo "<br>";
Yii::$app->formatter->locale = 'ru-RU';

/**************************  TIPS A TOMAR EN CUENTA  **************************/

Para hacer una busqueda en todos los elementos usar: CLASSNAME::FIND()->ALL(), EJ --> SysFormasOrg::find()->all()


/**************************   FORM  *******************************/

/*****************Use the namespace For ActiveFor*************/

use yii\helpers\Html;
use yii\widgets\ActiveForm;

Active Form Begin And End

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//$form = ActiveForm::begin(); //Default Active Form begin
$form = ActiveForm::begin([
    'id' => 'active-form',
    'options' => [
                'class' => 'form-horizontal',
                'enctype' => 'multipart/form-data'
                ],
])
/* ADD FORM FIELDS */
ActiveForm::end();

/*****************Text Input Field***************/
?>
<?php
$form->field($model, 'desc')->textarea();
$form->field($model, 'desc')->textarea()->label('Description');
$form->field($model, 'desc')->textarea(array('rows'=>2,'cols'=>5));


/*****************Text Input Field***************/

 $form->field($model, 'desc')->textarea();
$form->field($model, 'desc')->textarea()->label('Description');
$form->field($model, 'desc')->textarea(array('rows'=>2,'cols'=>5));

/*****************Password Input Field***************/

//Format 1
$form->field($model, 'password')->input('password')
//Format 2
$form->field($model, 'password')->passwordInput()
//Format 3
$form->field($model, 'password')->passwordInput()->hint('Password should be within A-Za-z0-9')->label('Password Hint')


/*****************Email Input Field***************/
$form->field($model, 'email')->input('email')

/*****************File Upload***************/
$form->field($model, 'uploadFile')->fileInput()
echo $form->field($model, 'uploadFile[]')->fileInput(['multiple'=>'multiple']);


/*****************Checkbox Button Field***************/
<!-- CHECKBOX BUTTON DEFAULT LABEL -->
 $form->field($model, 'population')->checkbox(); 
<!-- CHECKBOX BUTTON WITHOUT LABEL -->
 $form->field($model, 'population')->checkbox(array('label'=>'')); 
<!-- CHECKBOX BUTTON WITH CUSTOM LABEL -->
 $form->field($model, 'population')  ->checkbox(array('label'=>''))
                                        ->label('Gender'); 
<!-- CHECKBOX BUTTON WITH LABEL OPTIONS, DISABLED AND STYLE PROPERTIES -->
 $form->field($model, 'population')->checkbox(array(
                                'label'=>'',
                                'labelOptions'=>array('style'=>'padding:5px;'),
                                'disabled'=>true                                
                                ))
                                ->label('Gender'); 


/*****************Checkbox List Input Field***************/
echo $form->field($model, 'name[]')->checkboxList(['a' => 'Item A', 'b' => 'Item B', 'c' => 'Item C']);


/*****************Radio Button Field***************/
<!-- RADIO BUTTON DEFAULT LABEL -->
$form->field($model, 'gender')->radio();
<!-- RADIO BUTTON WITHOUT LABEL -->
$form->field($model, 'gender')->radio(array('label'=>''));
<!-- RADIO BUTTON WITH CUSTOM LABEL -->
$form->field($model, 'gender')  ->radio(array('label'=>''))
                                        ->label('Gender');
<!-- RADIO BUTTON WITH LABEL OPTIONS -->

$form->field($model, 'gender')->radio(array(
                                'label'=>'',
                                'labelOptions'=>array('style'=>'padding:5px;')))
                                ->label('Gender');



$form->field($model, 'population')->radioList(array('1'=>'One',2=>'Two'));


/*****************ListBox Field***************/
<!-- Listbox with prompt text -->
$form->field($model, 'population')-> listBox(
            array('1'=>'1',2=>'2',3=>3,4=>4,5=>5),
            array('prompt'=>'Select')
            ); 
<!-- Listbox with size -->
 $form->field($model, 'population')-> listBox(
            array('1'=>'1',2=>'2',3=>3,4=>4,5=>5),
            array('prompt'=>'Select','size'=>3)
            ); 
<!-- Listbox with disabled, style properties -->
 $form->field($model, 'population')-> listBox(
            array('1'=>'1',2=>'2',3=>3,4=>4,5=>5),
            array('disabled' => true,'style'=>'background:gray;color:#fff;'))
            ->label('Gender');


/*****************dropDown List Input Field***************/

use yii\helpers\ArrayHelper;

 $dimensionTypes = ArrayHelper::map(DimensionType::find()->orderBy('name')->all(), 'id', 'name')
 Html::dropDownList('price_type_id', null, $dimensionTypes, array('label' => 'Dimension type'))

$form->field($model, 'sys_tipo_bien_id')->dropDownList(
            $tipoBien,
            ['prompt'=>'Seleccione tipo de bien']
        );


//<!--link http://www.bsourcecode.com/yiiframework2/yii2-0-activeform-input-fields/-->
/*******************************END FORM ELEMENT*********************************/



/**************************   MANEJO DE BASE DE DATOS   **************************/

                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCustomer->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }


/**************************   WIDGETS/EXTENSIONES   **************************/

    // Fuentes:
    //http://demos.krajee.com/

        //** WIDGET SELECT 2 **//
        use kartik\select2\Select2;

        // setup the following to get the existing data from database
        $model->color = 'red, black, cyan';
         
        // or if the data is an array you can preselect the tags like this
        $model->color = implode(', ', ["red", "black", "cyan"]);
         
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'color',
            'options' => ['placeholder' => 'Select a color ...'],
            'pluginOptions' => [
                'tags' => ["red", "green", "white", "black", "purple", "cyan"],
                'maximumInputLength' => 10
            ],
        ]);

         $form->field($model, 'cliente_id')->widget(Select2::classname(), [
                'data' => $clientes,
                'options' => ['placeholder' => 'Seleccionar cliente'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])


        //** WIDGET DATETIMEPICKER **//
        use kartik\datetime\DateTimePicker;
            echo '<label>Fecha Factura</label>';
            echo DateTimePicker::widget([
                'model' => $model,
                'attribute' => 'fecha',
                //'name' => 'datetime_10',
                'options' => ['placeholder' => 'Selecciona fecha ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'd-M-yyyy h:i P',
                    'startDate' => date('d-m-Y h:i A'),//'01-Mar-2014 12:00 AM',
                    'todayHighlight' => true
                ]
            ]);


use kartik\widgets\DatePicker
 
// usage without model
echo '<label>Check Issue Date</label>';
echo DatePicker::widget([
    'name' => 'check_issue_date', 
    'value' => date('d-M-Y', strtotime('+2 days')),,
    'options' => ['placeholder' => 'Select issue date ...'],
    'pluginOptions' => [
        'format' => 'dd-M-yyyy',
        'todayHighlight' => true
    ]
]);


use kartik\widgets\TimePicker
 
// usage without model
echo '<label>Event Time</label>';
echo TimePicker::widget([
    'name' => 'event-time', 
    'pluginOptions' => [
        'minuteStep' => 1,
        'showSeconds' => true,
        'showMeridian' => false
    ]
]);

?>

<?php // Fuentes:
// http://snapcode.co/snap/list/category/122/yii2

?>

<?php 
//Check if request is ajax request.

public function actionDelete() {
        if (Yii::$app->request->isAjax) {
            // request is ajax request
        }
        else {
            // not ajax request
            // for example redirect
        }
}
?>
<?php
	//make dropdown select from database foreign key value

	//view active form
 $priceTypes = ArrayHelper::map(\app\models\PriceType::find()->orderBy('name')->all(), 'id', 'name') ?>
<?= $form->field($model, 'price_type_id')->dropDownList($priceTypes, ['prompt' => '---- Select price type ----'])->label('price type') ?>

<?php
//Yii2 check if record exists with where condition
 $exists = ModelName::find()->where([ 'column_name' => $value])->andWhere(['column_name' => $value])->exists();
//returns true or false
?>


<?php
//Gettin logged user in yii2 framework
//whole logged user
$user = \Yii::$app->user->identity;

//id of logged user
$userId = \Yii::$app->user->identity->id
?>



<?php
//Getting parameter from request
//geting all parameters
$parameters = \yii::$app->getRequest()->getQueryParams();
?>



<?php
//find many to many relationship objects
/*
For example. Product can have many tags. Product tags can be found with this active record query:

table structure:

table: Product
-   id

table: Tag
-   id
-   name

table:  Product_tag
-   id
- product_id
- tag_id*/


$currentTags = Tag::find()->innerJoin('product_tag', 'tag.id = product_tag.tag_id')->where(['product_id' => $model->id])->all();
?>



/**************************   MODULO DE USUARIOS   **************************/


Usage

You controllers may have two properties that will make whole controller or selected action accessible to everyone

public $freeAccess = true;
Or

public $freeAccessActions = ['first-action', 'another-action'];
Here are list of the useful helpers. For detailed explanation look in the corresponding functions.


User::hasRole($roles, $superAdminAllowed = true)
User::hasPermission($permission, $superAdminAllowed = true)
User::canRoute($route, $superAdminAllowed = true)

User::assignRole($userId, $roleName)
User::revokeRole($userId, $roleName)

User::getCurrentUser($fromSingleton = true)
Role, Permission and Route all have following methods


Role::create($name, $description = null, $groupCode = null, $ruleName = null, $data = null)
Role::addChildren($parentName, $childrenNames, $throwException = false)
Role::removeChildren($parentName, $childrenNames)
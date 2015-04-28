<?php

namespace common\models\p;

use Yii;

/**
 * This is the model class for table "public.acciones".
 *
 * @property integer $id
 * @property integer $numero_comun
 * @property integer $numero_preferencial
 * @property string $valor_comun
 * @property string $valor_preferencial
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 * @property boolean $suscrito
 * @property integer $acta_constitutiva_id
 * @property string $tipo_accion
 *
 * @property ActasConstitutivas $actaConstitutiva
 */
class Acciones extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'public.acciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero_comun', 'numero_preferencial', 'acta_constitutiva_id'], 'integer'],
            [['valor_comun', 'valor_preferencial'], 'number'],
            [['sys_status', 'suscrito'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['suscrito', 'acta_constitutiva_id'], 'required'],
            [['tipo_accion'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'numero_comun' => Yii::t('app', 'Numero Comun'),
            'numero_preferencial' => Yii::t('app', 'Numero Preferencial'),
            'valor_comun' => Yii::t('app', 'Valor Comun'),
            'valor_preferencial' => Yii::t('app', 'Valor Preferencial'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
            'suscrito' => Yii::t('app', 'Suscrito'),
            'acta_constitutiva_id' => Yii::t('app', 'Acta Constitutiva ID'),
            'tipo_accion' => Yii::t('app', 'Tipo Accion'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActaConstitutiva()
    {
        return $this->hasOne(ActasConstitutivas::className(), ['id' => 'acta_constitutiva_id']);
    }
}

<?php

namespace common\models\activos;

use Yii;

/**
 * This is the model class for table "activos.deterioros".
 *
 * @property integer $id
 * @property integer $bien_id
 * @property string $valor_razonable
 * @property string $costo_disposicion
 * @property string $valor_uso
 * @property string $acumulado_ejer_ant
 * @property string $ejercicios_anteriores
 * @property boolean $sys_status
 * @property string $sys_creado_el
 * @property string $sys_actualizado_el
 * @property string $sys_finalizado_el
 *
 * @property Bienes $bien
 */
class Deterioros extends \common\components\BaseActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activos.deterioros';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bien_id', 'valor_razonable', 'costo_disposicion', 'valor_uso'], 'required'],
            [['bien_id'], 'integer'],
            [['valor_razonable', 'costo_disposicion', 'valor_uso', 'acumulado_ejer_ant', 'ejercicios_anteriores'], 'number'],
            [['sys_status'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bien_id' => Yii::t('app', 'Bien ID'),
            'valor_razonable' => Yii::t('app', 'Valor Razonable'),
            'costo_disposicion' => Yii::t('app', 'Costo Disposicion'),
            'valor_uso' => Yii::t('app', 'Valor Uso'),
            'acumulado_ejer_ant' => Yii::t('app', 'Acumulado Ejer Ant'),
            'ejercicios_anteriores' => Yii::t('app', 'Ejercicios Anteriores'),
            'sys_status' => Yii::t('app', 'Sys Status'),
            'sys_creado_el' => Yii::t('app', 'Sys Creado El'),
            'sys_actualizado_el' => Yii::t('app', 'Sys Actualizado El'),
            'sys_finalizado_el' => Yii::t('app', 'Sys Finalizado El'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBien()
    {
        return $this->hasOne(Bienes::className(), ['id' => 'bien_id']);
    }
}

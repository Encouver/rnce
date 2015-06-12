<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\FondosEmergencias;

/**
 * FondosEmergenciasSearch represents the model behind the search form about `common\models\p\FondosEmergencias`.
 */
class FondosEmergenciasSearch extends FondosEmergencias
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero_plazo', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['fecha_cierre', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['saldo_fondo', 'monto_perdida', 'monto_utilizado', 'monto_asociados', 'tasa_interes', 'saldo_fondo_actual', 'monto_actual'], 'number'],
            [['corto_plazo', 'interes', 'sys_status'], 'boolean'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = FondosEmergencias::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_cierre' => $this->fecha_cierre,
            'saldo_fondo' => $this->saldo_fondo,
            'monto_perdida' => $this->monto_perdida,
            'monto_utilizado' => $this->monto_utilizado,
            'monto_asociados' => $this->monto_asociados,
            'corto_plazo' => $this->corto_plazo,
            'numero_plazo' => $this->numero_plazo,
            'interes' => $this->interes,
            'tasa_interes' => $this->tasa_interes,
            'saldo_fondo_actual' => $this->saldo_fondo_actual,
            'monto_actual' => $this->monto_actual,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => Yii::$app->user->identity->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
        ]);

        return $dataProvider;
    }
}

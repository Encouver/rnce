<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasHhPasivoLaboral;

/**
 * CuentasHhPasivoLaboralSearch represents the model behind the search form about `common\models\c\CuentasHhPasivoLaboral`.
 */
class CuentasHhPasivoLaboralSearch extends CuentasHhPasivoLaboral
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'creado_por', 'actualizado_por', 'hh_concepto_id'], 'integer'],
            [['saldo_p_anterior', 'importe_gasto_ejer_eco', 'importe_pago_ejer_eco', 'saldo_al_cierre'], 'number'],
            [['corriente', 'sys_status'], 'boolean'],
            [['anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
           
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
        $query = CuentasHhPasivoLaboral::find();

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
            'saldo_p_anterior' => $this->saldo_p_anterior,
            'importe_gasto_ejer_eco' => $this->importe_gasto_ejer_eco,
            'importe_pago_ejer_eco' => $this->importe_pago_ejer_eco,
            'saldo_al_cierre' => $this->saldo_al_cierre,
            'corriente' => $this->corriente,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'hh_concepto_id' => $this->hh_concepto_id,
            'otro_nombre' => $this->otro_nombre,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}

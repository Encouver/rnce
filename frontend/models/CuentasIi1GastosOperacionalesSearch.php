<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasIi1GastosOperacionales;

/**
 * CuentasIi1GastosOperacionalesSearch represents the model behind the search form about `common\models\c\CuentasIi1GastosOperacionales`.
 */
class CuentasIi1GastosOperacionalesSearch extends CuentasIi1GastosOperacionales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['tipo_gasto', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['ventas_hist', 'ventas_ajustado', 'admin_hist', 'admin_ajustado'], 'number'],
            [['sys_status'], 'boolean'],
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
        $query = CuentasIi1GastosOperacionales::find();

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
            'ventas_hist' => $this->ventas_hist,
            'ventas_ajustado' => $this->ventas_ajustado,
            'admin_hist' => $this->admin_hist,
            'admin_ajustado' => $this->admin_ajustado,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'tipo_gasto', $this->tipo_gasto])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}

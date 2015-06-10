<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasIi3GastosFuncionamiento;

/**
 * CuentasIi3GastosFuncionamientoSearch represents the model behind the search form about `common\models\c\CuentasIi3GastosFuncionamiento`.
 */
class CuentasIi3GastosFuncionamientoSearch extends CuentasIi3GastosFuncionamiento
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'concepto_id', 'admin_metodo_id', 'ventas_metodo_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['administracion', 'administracion_ajustadas', 'ventas', 'ventas_ajustadas'], 'number'],
            [['anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = CuentasIi3GastosFuncionamiento::find();

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
            'concepto_id' => $this->concepto_id,
            'administracion' => $this->administracion,
            'admin_metodo_id' => $this->admin_metodo_id,
            'administracion_ajustadas' => $this->administracion_ajustadas,
            'ventas' => $this->ventas,
            'ventas_metodo_id' => $this->ventas_metodo_id,
            'ventas_ajustadas' => $this->ventas_ajustadas,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}

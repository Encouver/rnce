<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasB2OtrasCuentasPorCobrar;

/**
 * CuentasB2OtrasCuentasPorCobrarSearch represents the model behind the search form about `common\models\c\CuentasB2OtrasCuentasPorCobrar`.
 */
class CuentasB2OtrasCuentasPorCobrarSearch extends CuentasB2OtrasCuentasPorCobrar
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'plazo_contrato_c', 'plazo_contrato_nc', 'criterio_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['criterio', 'origen', 'fecha', 'garantia', 'otro_nombre', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['corriente', 'nocorriente', 'sys_status'], 'boolean'],
            [['saldo_neto_c', 'saldo_neto_nc'], 'number'],
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
        $query = CuentasB2OtrasCuentasPorCobrar::find();

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
            'fecha' => $this->fecha,
            'corriente' => $this->corriente,
            'nocorriente' => $this->nocorriente,
            'plazo_contrato_c' => $this->plazo_contrato_c,
            'saldo_neto_c' => $this->saldo_neto_c,
            'plazo_contrato_nc' => $this->plazo_contrato_nc,
            'saldo_neto_nc' => $this->saldo_neto_nc,
            'criterio_id' => $this->criterio_id,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'criterio', $this->criterio])
            ->andFilterWhere(['like', 'origen', $this->origen])
            ->andFilterWhere(['like', 'garantia', $this->garantia])
            ->andFilterWhere(['like', 'otro_nombre', $this->otro_nombre])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}

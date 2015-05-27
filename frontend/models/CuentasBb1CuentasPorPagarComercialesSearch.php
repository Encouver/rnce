<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasBb1CuentasPorPagarComerciales;

/**
 * CuentasBb1CuentasPorPagarComercialesSearch represents the model behind the search form about `common\models\c\CuentasBb1CuentasPorPagarComerciales`.
 */
class CuentasBb1CuentasPorPagarComercialesSearch extends CuentasBb1CuentasPorPagarComerciales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'proveedor_id', 'cantidad_factura', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['saldo_al_cierre', 'intereses_actividad_e'], 'number'],
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
        $query = CuentasBb1CuentasPorPagarComerciales::find();

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
            'proveedor_id' => $this->proveedor_id,
            'cantidad_factura' => $this->cantidad_factura,
            'saldo_al_cierre' => $this->saldo_al_cierre,
            'intereses_actividad_e' => $this->intereses_actividad_e,
            'corriente' => $this->corriente,
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

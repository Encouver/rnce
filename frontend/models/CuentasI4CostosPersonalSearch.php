<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\c\CuentasI4CostosPersonal;

/**
 * CuentasI4CostosPersonalSearch represents the model behind the search form about `common\models\c\CuentasI4CostosPersonal`.
 */
class CuentasI4CostosPersonalSearch extends CuentasI4CostosPersonal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'metodo_inflacion_directa', 'metodo_inflacion_indirecta', 'concepto_id', 'cp_objeto_id', 'contratista_id', 'creado_por', 'actualizado_por'], 'integer'],
            [['monto_mano_directa', 'mdo_ajustado_directa', 'monto_mano_indirecta', 'mdo_ajustado_indirecta'], 'number'],
            [['desde_directa', 'hasta_directa', 'desde_indirecta', 'hasta_indirecta', 'especifique', 'anho', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = CuentasI4CostosPersonal::find();

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
            'monto_mano_directa' => $this->monto_mano_directa,
            'metodo_inflacion_directa' => $this->metodo_inflacion_directa,
            'desde_directa' => $this->desde_directa,
            'hasta_directa' => $this->hasta_directa,
            'mdo_ajustado_directa' => $this->mdo_ajustado_directa,
            'monto_mano_indirecta' => $this->monto_mano_indirecta,
            'metodo_inflacion_indirecta' => $this->metodo_inflacion_indirecta,
            'desde_indirecta' => $this->desde_indirecta,
            'hasta_indirecta' => $this->hasta_indirecta,
            'mdo_ajustado_indirecta' => $this->mdo_ajustado_indirecta,
            'concepto_id' => $this->concepto_id,
            'cp_objeto_id' => $this->cp_objeto_id,
            'contratista_id' => $this->contratista_id,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'especifique', $this->especifique])
            ->andFilterWhere(['like', 'anho', $this->anho]);

        return $dataProvider;
    }
}

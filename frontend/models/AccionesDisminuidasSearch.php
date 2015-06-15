<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\AccionesDisminuidas;

/**
 * AccionesDisminuidasSearch represents the model behind the search form about `common\models\p\AccionesDisminuidas`.
 */
class AccionesDisminuidasSearch extends AccionesDisminuidas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero_comun', 'numero_preferencial', 'numero_comun_actual', 'numero_preferencial_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['justificacion', 'tipo_disminucion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['valor_comun', 'valor_preferencial', 'valor_comun_actual', 'valor_preferencial_actual', 'capital_social'], 'number'],
            [['sys_status', 'actual'], 'boolean'],
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
        $query = AccionesDisminuidas::find();

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
            'valor_comun' => $this->valor_comun,
            'valor_preferencial' => $this->valor_preferencial,
            'numero_comun' => $this->numero_comun,
            'numero_preferencial' => $this->numero_preferencial,
            'valor_comun_actual' => $this->valor_comun_actual,
            'valor_preferencial_actual' => $this->valor_preferencial_actual,
            'numero_comun_actual' => $this->numero_comun_actual,
            'numero_preferencial_actual' => $this->numero_preferencial_actual,
            'capital_social' => $this->capital_social,
            'creado_por' => $this->creado_por,
            'actualizado_por' => $this->actualizado_por,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'contratista_id' => $this->contratista_id,
            'documento_registrado_id' => $this->documento_registrado_id,
            'actual' => $this->actual,
        ]);

        $query->andFilterWhere(['like', 'justificacion', $this->justificacion])
            ->andFilterWhere(['like', 'tipo_disminucion', $this->tipo_disminucion]);

        return $dataProvider;
    }
}

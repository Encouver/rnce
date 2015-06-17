<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\SuplementariosDisminuidos;

/**
 * SuplementariosDisminuidosSearch represents the model behind the search form about `common\models\p\SuplementariosDisminuidos`.
 */
class SuplementariosDisminuidosSearch extends SuplementariosDisminuidos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'numero', 'numero_actual', 'creado_por', 'actualizado_por', 'contratista_id', 'documento_registrado_id'], 'integer'],
            [['justificacion', 'tipo_disminucion', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
            [['valor', 'valor_actual', 'capital_social'], 'number'],
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
        $query = SuplementariosDisminuidos::find();

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
            'valor' => $this->valor,
            'numero' => $this->numero,
            'valor_actual' => $this->valor_actual,
            'numero_actual' => $this->numero_actual,
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

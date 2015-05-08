<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\AccionistasOtros;

/**
 * AccionistasOtrosSearch represents the model behind the search form about `common\models\p\AccionistasOtros`.
 */
class AccionistasOtrosSearch extends AccionistasOtros
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'natural_juridica_id', 'documento_registrado_id', 'empresa_fusionada_id'], 'integer'],
            [['porcentaje_accionario', 'valor_compra'], 'number'],
            [['fecha', 'cargo', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'repr_legal_vigencia', 'tipo_obligacion'], 'safe'],
            [['accionista', 'junta_directiva', 'rep_legal', 'sys_status'], 'boolean'],
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
        $query = AccionistasOtros::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'contratista_id' => $this->contratista_id,
            'natural_juridica_id' => $this->natural_juridica_id,
            'porcentaje_accionario' => $this->porcentaje_accionario,
            'valor_compra' => $this->valor_compra,
            'fecha' => $this->fecha,
            'accionista' => $this->accionista,
            'junta_directiva' => $this->junta_directiva,
            'rep_legal' => $this->rep_legal,
            'documento_registrado_id' => $this->documento_registrado_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'repr_legal_vigencia' => $this->repr_legal_vigencia,
            'empresa_fusionada_id' => $this->empresa_fusionada_id,
        ]);

        $query->andFilterWhere(['like', 'cargo', $this->cargo])
            ->andFilterWhere(['like', 'tipo_obligacion', $this->tipo_obligacion]);

        return $dataProvider;
    }
}

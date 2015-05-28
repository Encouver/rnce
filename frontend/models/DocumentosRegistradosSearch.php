<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\a\DocumentosRegistrados;

/**
 * DocumentosRegistradosSearch represents the model behind the search form about `common\models\a\DocumentosRegistrados`.
 */
class DocumentosRegistradosSearch extends DocumentosRegistrados
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'contratista_id', 'sys_tipo_registro_id'], 'integer'],
            [['circunscripcion', 'num_registro_notaria', 'tomo', 'folio', 'fecha_registro', 'fecha_asamblea', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el','proceso_finalizado'], 'safe'],
            [['valor_adquisicion'], 'number'],
            [['sys_status','proceso_finalizado'], 'boolean'],
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
        $query = DocumentosRegistrados::find();

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
            'sys_tipo_registro_id' => $this->sys_tipo_registro_id,
            'fecha_registro' => $this->fecha_registro,
            'valor_adquisicion' => $this->valor_adquisicion,
            'fecha_asamblea' => $this->fecha_asamblea,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'proceso_finalizado' => $this->proceso_finalizado,
        ]);

        $query->andFilterWhere(['like', 'circunscripcion', $this->circunscripcion])
            ->andFilterWhere(['like', 'num_registro_notaria', $this->num_registro_notaria])
            ->andFilterWhere(['like', 'tomo', $this->tomo])
            ->andFilterWhere(['like', 'folio', $this->folio]);

        return $dataProvider;
    }
}

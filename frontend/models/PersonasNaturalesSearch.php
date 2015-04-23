<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\PersonasNaturales;

/**
 * PersonasNaturalesSearch represents the model behind the search form about `common\models\p\PersonasNaturales`.
 */
class PersonasNaturalesSearch extends PersonasNaturales
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ci', 'creado_por', 'sys_pais_id'], 'integer'],
            [['primer_nombre', 'segundo_nombre', 'rif', 'primer_apellido', 'segundo_apellido', 'telefono_local', 'telefono_celular', 'fax', 'correo', 'pagina_web', 'facebook', 'twitter', 'instagram', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'numero_identificacion', 'nacionalidad'], 'safe'],
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
        $query = PersonasNaturales::find();

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
            'ci' => $this->ci,
            'creado_por' => $this->creado_por,
            'sys_pais_id' => $this->sys_pais_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'primer_nombre', $this->primer_nombre])
            ->andFilterWhere(['like', 'segundo_nombre', $this->segundo_nombre])
            ->andFilterWhere(['like', 'rif', $this->rif])
            ->andFilterWhere(['like', 'primer_apellido', $this->primer_apellido])
            ->andFilterWhere(['like', 'segundo_apellido', $this->segundo_apellido])
            ->andFilterWhere(['like', 'telefono_local', $this->telefono_local])
            ->andFilterWhere(['like', 'telefono_celular', $this->telefono_celular])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'pagina_web', $this->pagina_web])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'twitter', $this->twitter])
            ->andFilterWhere(['like', 'instagram', $this->instagram])
            ->andFilterWhere(['like', 'numero_identificacion', $this->numero_identificacion])
            ->andFilterWhere(['like', 'nacionalidad', $this->nacionalidad]);

        return $dataProvider;
    }
}

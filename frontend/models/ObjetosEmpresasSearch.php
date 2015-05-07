<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\ObjetosEmpresas;

/**
 * ObjetosEmpresasSearch represents the model behind the search form about `common\models\p\ObjetosEmpresas`.
 */
class ObjetosEmpresasSearch extends ObjetosEmpresas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'empresa_relacionada_id', 'contratista_id'], 'integer'],
            [['contratista', 'sys_status', 'productor', 'fabricante', 'fabricante_importado', 'distribuidor', 'distribuidor_autorizado', 'distribuidor_importador', 'dist_importador_aut', 'servicio_basico', 'servicio_profesional', 'servicio_comercial', 'ser_comercial_aut', 'obra'], 'boolean'],
            [['sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el'], 'safe'],
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
        $query = ObjetosEmpresas::find();

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
            'contratista' => $this->contratista,
            'empresa_relacionada_id' => $this->empresa_relacionada_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
            'productor' => $this->productor,
            'fabricante' => $this->fabricante,
            'fabricante_importado' => $this->fabricante_importado,
            'distribuidor' => $this->distribuidor,
            'distribuidor_autorizado' => $this->distribuidor_autorizado,
            'distribuidor_importador' => $this->distribuidor_importador,
            'dist_importador_aut' => $this->dist_importador_aut,
            'servicio_basico' => $this->servicio_basico,
            'servicio_profesional' => $this->servicio_profesional,
            'servicio_comercial' => $this->servicio_comercial,
            'ser_comercial_aut' => $this->ser_comercial_aut,
            'obra' => $this->obra,
            'contratista_id' => $this->contratista_id,
        ]);

        return $dataProvider;
    }
}

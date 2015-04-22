<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\p\Contratistas;

/**
 * ContratistasSearch represents the model behind the search form about `common\models\p\Contratistas`.
 */
class ContratistasSearch extends Contratistas
{
    /**
     * @inheritdoc
     */
    public $rif;
    public function rules()
    {
        return [
            [['id', 'rif','natural_juridica_id', 'estatus_contratista_id', 'ppal_caev_id', 'comp1_caev_id', 'comp2_caev_id', 'contacto_id'], 'integer'],
            [['sigla', 'principio_contable', 'sys_creado_el', 'sys_actualizado_el', 'sys_finalizado_el', 'tipo_sector'], 'safe'],
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
        $query = Contratistas::find();

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
            'natural_juridica_id' => $this->natural_juridica_id,
            'rif'=>$this->rif,
            'estatus_contratista_id' => $this->estatus_contratista_id,
            'ppal_caev_id' => $this->ppal_caev_id,
            'comp1_caev_id' => $this->comp1_caev_id,
            'comp2_caev_id' => $this->comp2_caev_id,
            'contacto_id' => $this->contacto_id,
            'sys_status' => $this->sys_status,
            'sys_creado_el' => $this->sys_creado_el,
            'sys_actualizado_el' => $this->sys_actualizado_el,
            'sys_finalizado_el' => $this->sys_finalizado_el,
        ]);

        $query->andFilterWhere(['like', 'sigla', $this->sigla])
            ->andFilterWhere(['like', 'principio_contable', $this->principio_contable])
            ->andFilterWhere(['like', 'tipo_sector', $this->tipo_sector]);

        return $dataProvider;
    }
     public function webservices($params)
    {
         
         $respuesta= true;
         if($repuesta){
             $persona_juridica = new PersonasJuridicas;
             $persona_juridica->rif = 'J-45675656-6';
             $persona_juridica->razon_social = 'EurekaSolutions C.A';
             $persona_juridica->nacionalidad = false;
             $persona_juridica->save();
             
             
             $nat_jur = new SysNaturalesJuridicas();
             $nat_jur->rif = $persona_juridica->rif;
             $nat_jur->denominacion= $persona_juridica->razon_social;
             $nat_jur->juridica= true;
             $nat_jur->save();
             
             $this->natural_juridica_id= $nat_jur->id;
             
             return true;
              
         }else{
             return false;
         }
         
    }
}

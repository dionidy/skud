<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Absence;

/**
 * AbsenceSearch represents the model behind the search form of `app\models\Absence`.
 */
class AbsenceSearch extends Absence
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employee_id', 'type_id'], 'integer'],
            [['date_start', 'date_end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Absence::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'type_id' => $this->type_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
        ]);

        return $dataProvider;
    }
}

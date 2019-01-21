<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\PrePaid;

/**
 * PrePaidSearch represents the model behind the search form of `common\models\PrePaid`.
 */
class PrePaidSearch extends PrePaid
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employeeId', 'amount'], 'integer'],
            [['date', 'comment'], 'safe'],
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
        $query = PrePaid::find();

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

        $month = '';
        $year='';
        if($this->date !=''){
            $m = date("m", strtotime($this->date));
            if($m < 10){
                $month = '0'.$m;
            }else{
                $month = $m;
            }
            $year = date("Y", strtotime($this->date));
        }else{
           $month = date('m');
           $year = date('y');
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employeeId' => $this->employeeId,
            'amount' => $this->amount,
            'MONTH(date)' => $month,
            'YEAR(date)' => $year,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}

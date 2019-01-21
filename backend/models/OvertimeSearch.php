<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Overtime;

/**
 * OvertimeSearch represents the model behind the search form of `common\models\Overtime`.
 */
class OvertimeSearch extends Overtime
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'employeeId', 'overtime'], 'integer'],
            [['date'], 'safe'],
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
        $query = Overtime::find();

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
        //var_dump($month);exit;

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'employeeId' => $this->employeeId,
            'overtime' => $this->overtime,
            'MONTH(`date`)' => $month,
            'YEAR(`date`)' => $year,
        ]);
        
        return $dataProvider;
    }
}

<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "pre_paid".
 *
 * @property int $id
 * @property int $employeeId
 * @property int $amount
 * @property string $date
 * @property string $comment
 *
 * @property Employee $employee
 */
class PrePaid extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'pre_paid';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['employeeId', 'amount', 'date'], 'required'],
            [['employeeId', 'amount'], 'integer'],
            [['date'], 'safe'],
            [['comment'], 'string'],
            [['employeeId'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['employeeId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'employeeId' => 'Employee',
            'amount' => 'Amount',
            'date' => 'Date',
            'comment' => 'Comment',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee() {
        return $this->hasOne(Employee::className(), ['id' => 'employeeId']);
    }

    public static function getMonthList() {
        $motnhs = (new Query())->select('DISTINCT MONTH(`date`) as months')->from('pre_paid')->column();
        return array_combine($motnhs, $motnhs);
    }

    public static function getPrepaidByMonth($date) {
        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));
        $prepaid = PrePaid::find()->where(['MONTH(date)' => $month, 'YEAR(date)'=>$year])->sum('amount');
        return $prepaid;
    }

}

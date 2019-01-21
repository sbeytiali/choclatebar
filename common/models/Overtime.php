<?php

namespace common\models;

use Yii;
use yii\db\Query;

/**
 * This is the model class for table "overtime".
 *
 * @property int $id
 * @property int $employeeId
 * @property int $overtime
 * @property string $date
 *
 * @property Employee $employee
 */
class Overtime extends \yii\db\ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'overtime';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['employeeId', 'overtime', 'date'], 'required'],
            [['employeeId', 'overtime'], 'integer'],
            [['date', 'amount'], 'safe'],
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
            'overtime' => 'Overtime',
            'date' => 'Date',
            'amount' => 'Amount'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployee() {
        return $this->hasOne(Employee::className(), ['id' => 'employeeId']);
    }

    public function amount() {
        return $this->employee->salary / 30 / 8 * $this->overtime;
    }

    public static function getMonthList() {
        $motnhs = (new Query())->select('DISTINCT MONTH(`date`) as months')->from('overtime')->column();
        //sprintf("%02d", $motnhs);
        return array_combine($motnhs, $motnhs);
    }

    public static function getYearList() {
        $years = (new Query())->select('DISTINCT YEAR(`date`) as years')->from('overtime')->column();
        //sprintf("%02d", $motnhs);
        return array_combine($years, $years);
    }

    public static function getOvertimesByMonth($date) {
        $month = date("m", strtotime($date));
        $year = date("Y", strtotime($date));
        $overtime = Overtime::find()->where(['MONTH(date)' => $month, 'YEAR(date)' => $year])->sum('amount');
        return $overtime;
    }

}

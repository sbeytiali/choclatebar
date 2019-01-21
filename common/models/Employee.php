<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "employee".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property string $startDate
 * @property int $salary
 */
class Employee extends \yii\db\ActiveRecord
{
    public static $cook = 1;
    public static $supervisor = 2;
    public static $waiter = 3;
    public static $argile = 4;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employee';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'startDate', 'salary'], 'required'],
            [['startDate'], 'safe'],
            [['salary'], 'integer'],
            [['name', 'title'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'title' => 'Title',
            'startDate' => 'Start Date',
            'salary' => 'Salary',
        ];
    }
    
    public static function getTitlesList()
    {
        return [
            self::$cook      => 'Cook',
            self::$supervisor => 'Super Visor',
            self::$waiter     => 'Waiter',
            self::$argile           => 'Argile'
        ];
    }

    public function getTitleName()
    {
        $array = self::getTitlesList();
        return (isset($array[$this->title])) ? $array[$this->title] : null;
    }
    
}

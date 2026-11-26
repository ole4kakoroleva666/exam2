<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property int $user_id
 * @property string $course_name
 * @property string $start_date
 * @property string $payment_method
 * @property string $status
 */
class Course extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const COURSE_NAME_OAIP = 'oaip';
    const COURSE_NAME_OWD = 'owd';
    const COURSE_NAME_OPBD = 'opbd';
    const PAYMENT_METHOD_CASH = 'cash';
    const PAYMENT_METHOD_TRANSACTION = 'transaction';
    const STATUS_NEW = 'new';
    const STATUS_IN_PROGRESS = 'in_progress';
    const STATUS_COMPLETED = 'completed';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 'new'],
            [['course_name', 'start_date', 'payment_method'], 'required'],
            [['user_id'], 'default', 'value' => Yii::$app->user->identity->id],
            [['course_name', 'payment_method', 'status'], 'string'],
            [['start_date'], 'safe'],
            ['course_name', 'in', 'range' => array_keys(self::optsCourseName())],
            ['payment_method', 'in', 'range' => array_keys(self::optsPaymentMethod())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'course_name' => 'Название курса',
            'start_date' => 'Дата начала',
            'payment_method' => 'Способ оплаты',
            'status' => 'Статус',
        ];
    }


    /**
     * column course_name ENUM value labels
     * @return string[]
     */
    public static function optsCourseName()
    {
        return [
            self::COURSE_NAME_OAIP => 'Основы алгоритмизации и программирования',
            self::COURSE_NAME_OWD => 'Основы веб-дизайна',
            self::COURSE_NAME_OPBD => 'Основы проектирование баз данных',
        ];
    }

    /**
     * column payment_method ENUM value labels
     * @return string[]
     */
    public static function optsPaymentMethod()
    {
        return [
            self::PAYMENT_METHOD_CASH => 'Наличными',
            self::PAYMENT_METHOD_TRANSACTION => 'Перевод по номеру телефона',
        ];
    }

    /**
     * column status ENUM value labels
     * @return string[]
     */
    public static function optsStatus()
    {
        return [
            self::STATUS_NEW => 'Новая',
            self::STATUS_IN_PROGRESS => 'Идет обучение',
            self::STATUS_COMPLETED => 'Обучение завершено',
        ];
    }

    /**
     * @return string
     */
    public function displayCourseName()
    {
        return self::optsCourseName()[$this->course_name];
    }

    /**
     * @return bool
     */
    public function isCourseNameOaip()
    {
        return $this->course_name === self::COURSE_NAME_OAIP;
    }

    public function setCourseNameToOaip()
    {
        $this->course_name = self::COURSE_NAME_OAIP;
    }

    /**
     * @return bool
     */
    public function isCourseNameOwd()
    {
        return $this->course_name === self::COURSE_NAME_OWD;
    }

    public function setCourseNameToOwd()
    {
        $this->course_name = self::COURSE_NAME_OWD;
    }

    /**
     * @return bool
     */
    public function isCourseNameOpbd()
    {
        return $this->course_name === self::COURSE_NAME_OPBD;
    }

    public function setCourseNameToOpbd()
    {
        $this->course_name = self::COURSE_NAME_OPBD;
    }

    /**
     * @return string
     */
    public function displayPaymentMethod()
    {
        return self::optsPaymentMethod()[$this->payment_method];
    }

    /**
     * @return bool
     */
    public function isPaymentMethodCash()
    {
        return $this->payment_method === self::PAYMENT_METHOD_CASH;
    }

    public function setPaymentMethodToCash()
    {
        $this->payment_method = self::PAYMENT_METHOD_CASH;
    }

    /**
     * @return bool
     */
    public function isPaymentMethodTransaction()
    {
        return $this->payment_method === self::PAYMENT_METHOD_TRANSACTION;
    }

    public function setPaymentMethodToTransaction()
    {
        $this->payment_method = self::PAYMENT_METHOD_TRANSACTION;
    }

    /**
     * @return string
     */
    public function displayStatus()
    {
        return self::optsStatus()[$this->status];
    }

    /**
     * @return bool
     */
    public function isStatusNew()
    {
        return $this->status === self::STATUS_NEW;
    }

    public function setStatusToNew()
    {
        $this->status = self::STATUS_NEW;
    }

    /**
     * @return bool
     */
    public function isStatusInprogress()
    {
        return $this->status === self::STATUS_IN_PROGRESS;
    }

    public function setStatusToInprogress()
    {
        $this->status = self::STATUS_IN_PROGRESS;
    }

    /**
     * @return bool
     */
    public function isStatusCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    public function setStatusToCompleted()
    {
        $this->status = self::STATUS_COMPLETED;
    }
}

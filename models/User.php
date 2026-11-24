<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "User".
 *
 * @property int $id
 * @property string $username
 * @property string $FIO
 * @property string $password
 * @property string $email
 * @property string $phone
 * @property string $role
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * ENUM field values
     */
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'User';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'FIO', 'password', 'email', 'phone'], 'required'],
            [['role'], 'default', 'value' => 'user'],
            ['email', 'email'],
            [['username'], 'unique'],
            ['username', 'match', 'pattern' => '/^[a-z]\w*$/i'],
            [['username', 'email'], 'string', 'max' => 100],
            ['username', 'string', 'min' => 6, 'max' => 255],
            [['FIO', 'password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 50],
            ['password', 'string', 'min' => 8, 'max' => 255],
            ['FIO', 'match', 'pattern' => '/^[А-яЁё\s]*$/u']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Логин',
            'FIO' => 'ФИО',
            'password' => 'Пароль',
            'email' => 'Электронная почта',
            'phone' => 'Номер телефона',
            'role' => 'Роль',
        ];
    }


    /**
     * column role ENUM value labels
     * @return string[]
     */
    public static function optsRole()
    {
        return [
            self::ROLE_USER => 'user',
            self::ROLE_ADMIN => 'admin',
        ];
    }

    /**
     * @return string
     */
    public function displayRole()
    {
        return self::optsRole()[$this->role];
    }

    /**
     * @return bool
     */
    public function isRoleUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function setRoleToUser()
    {
        $this->role = self::ROLE_USER;
    }

    /**
     * @return bool
     */
    public function isRoleAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function setRoleToAdmin()
    {
        $this->role = self::ROLE_ADMIN;
    }

    public static function findIdentity($id): static|null
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null): static|null
    {
        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername(string $username): static|null
    {
        return User::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string|null
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return false;
    }

    public function validatePassword($password){
        return $this->password === md5($password);
    }

    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }
}

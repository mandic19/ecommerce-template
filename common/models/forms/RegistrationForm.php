<?php

namespace common\models\forms;

use common\models\User;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class RegistrationForm
 * @package common\models\forms
 *
 * @property string $password
 * @property string $password_repeat
 * @property string $role
 *
 */
class RegistrationForm extends User
{
    const SCENARIO_ADMIN_REGISTRATION = 'admin-registration';
    const SCENARIO_CUSTOMER_REGISTRATION = 'customer-registration';
    const SCENARIO_ADMIN_UPDATE = 'admin-update';

    public $password;
    public $password_repeat;
    public $role;

    public function getBaseName()
    {
        return Yii::t('app', 'User');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['password', 'password_repeat'], 'required', 'on' => [static::SCENARIO_ADMIN_REGISTRATION, static::SCENARIO_CUSTOMER_REGISTRATION]],
            [['password'], 'compare', 'compareAttribute' => 'password_repeat', 'operator' => '==', 'when' => function (RegistrationForm $model) {
                return !empty($model->password) && !empty($model->password_repeat);
            }],
            [['role'], 'required', 'on' => [static::SCENARIO_ADMIN_REGISTRATION, static::SCENARIO_ADMIN_UPDATE]],
            [['role'], 'string']
        ]);
    }

    public function scenarios()
    {
        $allAttributes = $this->getAllAttributeNames();

        return ArrayHelper::merge(parent::scenarios(), [
            static::SCENARIO_ADMIN_REGISTRATION => $allAttributes,
            static::SCENARIO_ADMIN_UPDATE => $allAttributes,
            static::SCENARIO_CUSTOMER_REGISTRATION => array_diff($allAttributes, ['role'])
        ]);
    }

    public function beforeValidate()
    {
        $this->username = empty($this->username) ? $this->email : $this->username;
        $this->status = static::STATUS_ACTIVE;

        return parent::beforeValidate();
    }


    public function save($runValidation = true, $attributeNames = null)
    {
        if (!$this->validate()) {
            return false;
        }

        $this->setPassword($this->password);
        $this->generateAuthKey();

        $transaction = Yii::$app->db->beginTransaction();

        if(!parent::save($runValidation, $attributeNames)) {
            $transaction->rollBack();
            return false;
        }

        if(!empty($this->role)) {
            if(!$this->assignCustomRole($this->role)) {
                $transaction->rollBack();
                $this->addError('role', Yii::t('app', 'Failed while assigning role.'));
                return false;
            }
        }

        $transaction->commit();
        return true;
    }
}
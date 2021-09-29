<?php

use common\helpers\RbacHelper;
use yii\db\Migration;

/**
 * Class m210925_210650_insert_roles
 */
class m210925_210650_insert_roles extends Migration
{
    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $superAdminRole = $auth->createRole(RbacHelper::ROLE_SUPER_ADMIN);
        $superAdminRole->description = RbacHelper::getRoleLabel(RbacHelper::ROLE_SUPER_ADMIN);

        $adminRole = $auth->createRole(RbacHelper::ROLE_ADMIN);
        $adminRole->description = RbacHelper::getRoleLabel(RbacHelper::ROLE_ADMIN);

        $auth->add($superAdminRole);
        $auth->add($adminRole);
        $auth->addChild($superAdminRole, $adminRole);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $superAdminRole = $auth->createRole(RbacHelper::ROLE_SUPER_ADMIN);
        $adminRole = $auth->createRole(RbacHelper::ROLE_ADMIN);

        $auth->removeChild($superAdminRole, $adminRole);
        $auth->remove($superAdminRole);
        $auth->remove($adminRole);
    }
}

<?php

use common\models\User;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        echo "*** Creating main database structure for application. " . PHP_EOL;

        $query = file_get_contents(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'initial.sql');

        $success = Yii::$app->db->createCommand($query)->execute();

        $this->insert('user', [
            'username' => 'admin',
            'password_hash' => '$2y$13$xJD9uc/tFnoZbxLEcLt0muPrO/ASqmO9kTghRPOIZAbGp7VcnltaS', //password1996
            'email' => 'marko.mandic.engr@gmail.com',
            'status' => User::STATUS_ACTIVE,
            'created_at' => time()
        ]);

        return $success;
    }

    public function safeDown()
    {
        echo "m190123_101647_initial_database_structure cannot be reverted.\n";

        return false;
    }
}

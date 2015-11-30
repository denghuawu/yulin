<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
	const TABLE_NAME = '{{%admin_user}}';
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable(self::TABLE_NAME, [
            'user_id' => Schema::primaryKey(),
            'user_name' => Schema::string()->notNull()->unique(),
            'auth_key' => Schema::string(32)->notNull(),
            'password_hash' => Schema::string()->notNull(),
            'password_reset_token' => Schema::string()->unique(),
            'email' => Schema::string()->notNull()->default(null),
        	'mobile_phone' => Schema::string()->notNull()->unique(),
            'status' => Schema::smallInteger()->notNull()->default(10),
        	'role_id' => Schema::integer()->notNull(),
            'created_at' => Schema::integer()->notNull(),
            'updated_at' => Schema::integer()->notNull(),
        ], $tableOptions);
        
        $this->createIndex('username', self::TABLE_NAME, 'user_name', true);
        $this->createIndex('mobile_phone', self::TABLE_NAME, 'mobile_phone', true);
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_NAME);
    }
}

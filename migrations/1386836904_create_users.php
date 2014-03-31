<?php defined('SYSPATH') OR die('No direct script access.');
/**
* create_table($table_name, $fields, array('id' => TRUE, 'options' => ''))
* drop_table($table_name)
* rename_table($old_name, $new_name)
* add_column($table_name, $column_name, $params)
* rename_column($table_name, $column_name, $new_column_name)
* change_column($table_name, $column_name, $params)
* remove_column($table_name, $column_name)
* add_index($table_name, $index_name, $columns, $index_type = 'normal')
* remove_index($table_name, $index_name)
*/
class Create_Users extends Migration
{
	public function up()
	{
		$this->create_table('users',
			array(
				'id' 			=> 'primary_key',
				'email' 		=> array('type' => 'varchar(254)', 'null' => FALSE),
				'username' 		=> array('type' => 'varchar(32)', 'null' => FALSE),
				'password' 		=> array('type' => 'varchar(64)', 'null' => FALSE),
				'logins' 		=> array('type' => 'int(10)', 'unsigned' => TRUE, 'null' => FALSE, 'default' => '0'),
				'last_login' 	=> array('type' => 'int(10)', 'unsigned' => TRUE),
			),
			array(
				'options' => array('ENGINE=innoDB', 'DEFAULT', 'CHARSET=utf8'),
			)
		);

		$this->add_index('users', 'uniq_username', 'username', 'unique');
		$this->add_index('users', 'uniq_email', 'email', 'unique');

		$passwd = Auth::instance()->hash('admin');

		$this->execute("
			INSERT
				INTO `users` (`id`, `email`, `username`, `password`)
				VALUES(1, 'admin@default.com', 'admin', '{$passwd}');
		");

		Minion_CLI::write(Minion_CLI::color('DEFAULT USER', 'black', 'light_gray'));
		Minion_CLI::write(Minion_CLI::color('username: admin', 'black', 'light_gray'));
		Minion_CLI::write(Minion_CLI::color('password: admin', 'black', 'light_gray'));
	}

	public function down()
	{
		$this->drop_table('users');
	}
}

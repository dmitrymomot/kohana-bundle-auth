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
class Create_Role extends Migration
{
	public function up()
	{
		$this->create_table('roles',
			array(
				'id' => 'primary_key',
				'name' => array('type' => 'varchar(32)', 'null' => FALSE),
				'description' => array('type' => 'varchar(255)', 'null' => FALSE),
			),
			array(
				'options' => array('ENGINE=innoDB', 'DEFAULT', 'CHARSET=utf8'),
			)
		);

		$this->add_index('roles', 'uniq_name', 'name', 'unique');

		$this->execute("
			INSERT INTO `roles` (`id`, `name`, `description`) VALUES(1, 'login', 'Login privileges, granted after account confirmation');
			INSERT INTO `roles` (`id`, `name`, `description`) VALUES(2, 'admin', 'Administrative user, has access to everything.');
		");
	}

	public function down()
	{
		$this->drop_table('roles');
	}
}

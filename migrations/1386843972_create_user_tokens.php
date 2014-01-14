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
class Create_User_Tokens extends Migration
{
	public function up()
	{
		$this->create_table('user_tokens',
			array(
				'id' 			=> 'primary_key',
				'user_id' 		=> array('type' => 'int(10)', 		'null' => FALSE, 'unsigned' => TRUE),
				'user_agent' 	=> array('type' => 'varchar(40)', 	'null' => FALSE),
				'token' 		=> array('type' => 'varchar(40)', 	'null' => FALSE),
				'created' 		=> array('type' => 'int(10)', 		'null' => FALSE, 'unsigned' => TRUE),
				'expires' 		=> array('type' => 'int(10)', 		'null' => FALSE, 'unsigned' => TRUE),
			),
			array(
				'options' => 'ENGINE=innoDB DEFAULT CHARSET=utf8',
			)
		);

		$this->add_index('user_tokens', 'uniq_token', 'token', 'unique');
		$this->add_index('user_tokens', 'fk_user_id', 'user_id');
		$this->add_index('user_tokens', 'expires', 'expires');
	}

	public function down()
	{
		$this->drop_table('user_tokens');
	}
}

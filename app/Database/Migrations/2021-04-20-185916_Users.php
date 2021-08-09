<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
	public function up()
	{
		 $this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'idgoogle'       => [
                    'type'       => 'TEXT',
                    'unique'       => true,
	            ],
	            'nama'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
	            ],
	            'email'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'unique' => true,
	            ],
	            'negara'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
	            ],
	            'usia'       => [
                    'type'       => 'INT',
	            ],
	            'status'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default'	=>	'aktif'
	            ],
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}

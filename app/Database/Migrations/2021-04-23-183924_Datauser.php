<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Datauser extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'id_user'       => [
                    'type'       => 'BIGINT',
                    'null'       => false,
	            ],
	            'pekerjaan'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' => 'empty',
	            ],
	            'foto'       => [
                    'type'       => 'VARCHAR',
                    'constraint' => '255',
                    'default' => 'default.jpg',
	            ],
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->addForeignKey('id_user','users','id');
	    $this->forge->createTable('datauser');
	}

	public function down()
	{
		$this->forge->dropTable('datauser');
	}
}

<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class File extends Migration
{
	public function up()
	{
		$this->forge->addField([
	            'id'          => [
                    'type'           =>'BIGINT',
                    'unsigned'       => true,
                    'auto_increment' => true,
	            ],
	            'id_post'       => [
                    'type'       => 'BIGINT',
	            ],
	            'image'       => [
                    'type'       => 'TEXT',
                    'null'       =>  true,
	            ],
	            'video'       => [
                    'type'       => 'TEXT',
                    'null'       => true,
	            ],
	            'others'       => [
                    'type'       => 'TEXT',
                    'null'       => true,
	            ],
	            'created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
	            'deleted_at TIMESTAMP NULL',
	        ]);
	    $this->forge->addKey('id', true);
	    $this->forge->addForeignKey('id_post','post','id');
	    $this->forge->createTable('file');
	}

	public function down()
	{
		$this->forge->dropTable('file');
	}
}
